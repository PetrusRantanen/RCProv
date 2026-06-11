
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
            <button class="button is-primary" wire:click="create()">Lisää etiketti</button>
            @if($isOpen)
                @include('pages.labels.editlabel')
            @endif
        </div>
        <div class="card">
            <div class="card-header">
                <p class="card-header-title">
                    Lisätyt etiketit
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
                                    <th class="has-white-text">Tulostimen FTP-isäntänimi</th>
                                    <th class="has-white-text">Toiminnot</th>
                                </tr>
                            </thead>

                            <tbody>
                            @forelse($labels as $l)
                                <tr>
                                    <td>{{ $l->name }}</td>
                                    <td>{{ $l->printer_type }}</td>
                                    <td>@if ($l->printer_type == "ftp") {{ $l->ftp_hostname }} @else N/A @endif</td>
                                    <td>
                                        <button class="button is-small is-link" wire:click="edit({{ $l->id }})">Muokkaa</button>
                                        <button class="button is-small is-danger" wire:click="delete({{ $l->id }})">Poista</button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td class="has-text-centered" colspan="4">No entries</td></tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>