<?php

use App\Models\Cm;
use App\Models\Project;
use Livewire\Component;

new class extends Component
{
    public $CMs;

    public $modalOpen = false;

    public $cm;

    public $projectId = -1;

    public $projects;

    public function render()
    {
        if ($this->projectId == -1) {
            $this->projectId = Project::getActiveId();
        }

        if ($this->projectId) {
            $this->CMs = Cm::where('project_id', $this->projectId)->orderBy('id')->get();
        } else {
            $this->CMs = Cm::orderBy('id')->get();
        }
        $this->projects = Project::withCount('cms')->orderBy('name')->get();

        return $this->view();
    }

    public function openModal()
    {
        $this->modalOpen = true;
    }

    public function closeModal()
    {
        $this->modalOpen = false;
    }

    public function edit($id)
    {
        $this->cm = Cm::findOrFail($id);
        $this->openModal();
    }

    public function delete($id)
    {
        Cm::destroy($id);
        session()->flash('message', 'CM poistettu.');
    }

    public function cancel()
    {
        $this->closeModal();
    }

    public function exportCSV()
    {
        return response()->streamDownload(function () {
            $fd = fopen('php://output', 'w');

            if (count($this->CMs)) {
                fputcsv($fd, array_keys($this->CMs[0]->getAttributes()));

                foreach ($this->CMs as $cm) {
                    fputcsv($fd, $cm->getAttributes());
                }
            }
            fclose($fd);

        }, 'export-cm-'.date('Ymd').'.csv');
    }
};
