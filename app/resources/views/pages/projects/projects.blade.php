
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
            <button class="button is-primary" wire:click="create()">Lisää projekti</button>
            @if($isOpen)
                @include('pages.projects.editproject')
            @endif
        </div>
        <div class="card">
            <div class="card-header">
                <p class="card-header-title">
                    Lisätyt projektit
                </p>
            </div>
            <div class="card-content">
                <div class="content">
                    <div class="table-container">
                        <table class="table is-narrow is-fullwidth">
                            <thead>
                                <tr class="is-primary">
                                    <th class="has-white-text">Projektin nimi</th>
                                    <th class="has-white-text">Käyttää levykuvaa</th>
                                    <th class="has-white-text">Toiminnot</th>
                                </tr>
                            </thead>

                            <tbody>
                            @forelse($projects as $p)
                                <tr>
                                    <td>@if ($activeProject == $p->id) {{ $p->name }} <span class="is-italic has-text-weight-">(Aktiivinen projekti)</span> @else {{ $p->name }} @endif</td>
                                    <td>@if ($p->image) {{ $p->image->filename }} @else - @endif</td>
                                    <td>
                                        <button class="button is-small is-link" wire:click="edit({{ $p->id }})">Muokkaa</button>
                                        <button class="button is-small is-info" wire:click="setActive({{ $p->id }})">Aseta aktiiviseksi</button>
                                        <button class="button is-small is-danger" wire:click="delete({{ $p->id }})">Poista</button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td class="has-text-centered" colspan="3">Ei tallennettuja projekteja</td></tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>