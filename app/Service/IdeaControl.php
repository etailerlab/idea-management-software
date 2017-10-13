<?php

namespace App\Service;

use App\Models\Categories\Status;
use App\Models\Auth\User;
use App\Models\{
    Idea,
    Note
};
use App\Events\{
    IdeaWasCreated,
    IdeaWasApproved,
    IdeaWasDeclined,
    IdeaWasChangedStatus
};

/**
 * Class IdeaControl
 * @package App\Service
 */
class IdeaControl
{
    /**
     * @param User $user
     * @param array $data
     * @param Status $status
     * @return Idea
     */
    public function create(User $user, array $data, Status $status)
    {
        $idea = (new Idea($data));
        $idea->user_id = $user->id;
        $idea->status_id = $status->id;
        $idea->approve_status = Idea::NEW;
        $idea->save();
        $idea->coreCompetencies()->attach($data['core_competency_id']);
        $idea->departments()->attach($data['department_id']);
        $idea->operationalGoals()->attach($data['operational_goal_id']);
        $idea->strategicObjectives()->attach($data['strategic_objective_id']);

        event(new IdeaWasCreated($idea));

        return $idea;
    }

    /**
     * @param array $data
     * @return Idea
     */
    public function update(Idea $idea, array $data)
    {
        $idea->fill($data);
        $idea->save();
        $idea->coreCompetencies()->sync($data['core_competency_id'], 1);
        $idea->departments()->sync($data['department_id'], 1);
        $idea->operationalGoals()->sync($data['operational_goal_id'], 1);
        $idea->strategicObjectives()->sync($data['strategic_objective_id'], 1);

        return $idea;
    }

    /**
     * @param Idea $idea
     * @return Idea
     * @throws \App\Exceptions\IdeaApproved
     */
    public function approve(Idea $idea)
    {
        if (!$idea->isNew()) {
            throw new \App\Exceptions\IdeaApproved('Идея уже прошла этап модерации');
        }
        $idea->approve_status = Idea::APPROVED;
        $idea->save();
        event(new IdeaWasApproved($idea));

        return $idea;
    }

    /**
     * @param Idea $idea
     * @return Idea
     * @throws \App\Exceptions\IdeaApproved
     */
    public function decline(Idea $idea, string $reason)
    {
        if (!$idea->isNew()) {
            throw new \App\Exceptions\IdeaApproved('Идея уже прошла этап модерации');
        }
        $idea->approve_status = Idea::DECLINED;
        $idea->save();

        Note::create([
            'text' => $reason,
            'idea_id' => $idea->id,
            'type' => Note::TYPE_DECLINED_REASON,
        ]);
        event(new IdeaWasDeclined($idea));

        return $idea;
    }

    /**
     * @param Idea $idea
     * @param string $reason
     * @return Idea
     */
    public function pinToPriority(Idea $idea, string $reason)
    {
        $idea->is_priority = 1;
        $idea->save();

        $reasonModel = $idea->getPriorityReason();
        if ($reasonModel === null) {
            Note::create([
                'text' => $reason,
                'idea_id' => $idea->id,
                'type' => Note::TYPE_PRIORITY_REASON,
            ]);
        } else {
            $reasonModel->text = $reason;
            $reasonModel->save();
        }

        return $idea;
    }

    /**
     * @param Idea $idea
     * @return Idea
     */
    public function unpinToPriority(Idea $idea)
    {
        $idea->is_priority = 0;
        $idea->save();

        return $idea;
    }

    /**
     * @param Idea $idea
     * @param string $text
     * @return Idea
     * @throws \App\Exceptions\PriorityReasonNotFound
     */
    public function changePriorityReason(Idea $idea, string $text)
    {
        $reason = $idea->getPriorityReason();
        if ($reason === null) {
            throw new \App\Exceptions\PriorityReasonNotFound('Пояснительная записка не найденa');
        }

        $reason->text = $text;
        $reason->save();
        return $idea;
    }

    /**
     * @param Idea $idea
     * @param Status $status
     * @return Idea
     */
    public function changeStatus(Idea $idea, Status $status)
    {
        if (!$idea->isApproved()) {
            throw new \App\Exceptions\IdeaIsNotApproved('Вы не можете изменить статус неутвержденной идеи');
        }
        if ($idea->status_id !== $status->id) {
            $idea->status_id = $status->id;
            $idea->save();

            event(new IdeaWasChangedStatus($idea));
        }

        return $idea;
    }
}