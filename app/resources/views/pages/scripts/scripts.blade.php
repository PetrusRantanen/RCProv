
<div>
    @if (session()->has('message'))
    <div class="notification is-success" x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
    {{ session('message') }}
    </div>
    @endif

    @if (session()->has('error'))
    <div class="notification is-danger" x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
        {{ session('error') }}
    </div>
    @endif
    <div class="container">
        <div class="buttons">
            <button class="button is-primary" wire:click="create()">Lisää skripti</button>
            @if($isOpen)
                @include('pages.scripts.editscript')
            @endif
        </div>
        <div class="card">
            <div class="card-header">
                <p class="card-header-title">
                    Lisätyt skriptit
                </p>
            </div>
            <div class="card-content">
                <div class="content">
                    <div class="table-container">
                        <table class="table is-narrow is-fullwidth">
                            <thead>
                                <tr class="is-primary">
                                    <th class="has-white-text">Nimi</th>
                                    <th class="has-white-text">Tyyppi</th>
                                    <th class="has-white-text">Prioriteetti</th>
                                    <th class="has-white-text">Toiminnot</th>
                                </tr>
                            </thead>

                            <tbody>
                            @forelse($scripts as $s)
                                <tr>
                                    <td>{{ $s->name }}</td>
                                    <td>
                                    @if($s->script_type == 'preinstall')
                                        Esiasennus
                                    @else
                                        Jälkiasennus
                                    @endif
                                    </td>
                                    <td>{{ $s->priority }}</td>
                                    <td>
                                        <button class="button is-small is-link" wire:click="edit({{ $s->id }})">Muokkaa</button>
                                        <button class="button is-small is-danger" wire:click="delete({{ $s->id }})">Poista</button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td class="border px-4 py-2" colspan="4">No entries</td></tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>