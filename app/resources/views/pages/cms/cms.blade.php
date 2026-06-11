
<div>
    <div class="container">
        @if (session()->has('message'))
        <div class="notification is-success" x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
            {{ session('message') }}
        </div>
        @endif

        <div class="columns is-multiline">
            <div class="column is-full">
                <div class="container box">
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Suodata projektin mukaan:</label>
                        </div>
                        <div class="field-body">
                            <div class="field is-narrow">
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select wire:model.live="projectId">
                                            <option value="0">Kaikki projektit</option>
                                            @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->name }} ({{ $project->cms_count }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                        </div>
                        <div class="field-body">
                            <button class="button is-link" wire:click="exportCSV()">Vie CSV-tiedostona</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="column is-full">
                <div class="container card">
                    <div class="card-header">
                        <p class="card-header-title">CM-luettelo</p>
                    </div>
                    
                    <div class="card-content">
                        <div class="table-container">
                            <table class="table is-narrow is-fullwidth">
                                <thead>
                                    <tr class="is-primary">
                                        <th class="has-text-white">CM Sarjanumero</th>
                                        <th class="has-text-white">MAC-osoite</th>
                                        <th class="has-text-white">Moduulin tyyppi</th>
                                        <th class="has-text-white">Valmistelu valmis</th>
                                        <th class="has-text-white">Toiminnot</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($CMs as $c)
                                    <tr>
                                        <td>{{ $c->serial }}</td>
                                        <td>{{ $c->mac }}</td>
                                        <td>{{ $c->model }}</td>
                                        <td>@if ($c->provisioning_complete_at) {{ $c->provisioning_complete_at }} @else Ei valmis @endif</td>
                                        <td>
                                            <button class="button is-small is-link" wire:click="edit({{ $c->id }})">Tarkastele</button>
                                            <button class="button is-small is-danger" wire:click="delete({{ $c->id }})">Poista</button>
                                        </td> 
                                    </tr>
                                    @empty
                                    <tr><td colspan="3" class="has-text-centered">Merkintöjä ei löytynyt.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($cm)
    @include('pages.cms.viewcm')
    @endif

</div>