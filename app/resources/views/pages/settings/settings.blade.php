
<div>
    @if($logModalOpen)
        @include('pages.settings.viewlog')
    @elseif($staticModalOpen)
        @include('pages.settings.addstaticip')
    @endif

    @if (session()->has('message'))
    <div class="notification is-success" x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
    {{ session('message') }}
    </div>
    @endif

    <div class="columns is-multiline">
        <div class="column is-full">
            <div class="container card">
                <div class="card-header">
                    <p class="card-header-title">Palveluiden tila</p>
                </div>
                <div class="card-content">
                    <div class="table-container">
                        <table class="table is-fullwidth">
                            <thead>
                                <tr class="is-primary">
                                    <th class="has-text-white">Palvelun nimi</th>
                                    <th class="has-text-white">Tilanne</th>
                                    <th class="has-text-white">Näytä palvelun lokit</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Web-käyttöliittymä</td>
                                    <td>
                                        <span class="icon-text has-text-success">
                                            <span class="icon">
                                                <svg width="24px" height="24px" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM10.2426 14.4142L17.3137 7.34315L18.7279 8.75736L10.2426 17.2426L6 13L7.41421 11.5858L10.2426 14.4142Z" />
                                                </svg>
                                            </span>
                                            <span>Toiminnassa</span>
                                        </span>
                                    </td>
                                    <td><button class="button is-small is-primary" wire:click="viewLogLaravel()">Katso lokia</button></td>
                                </tr>
                                <tr>
                                    <td>dnsmasq (DHCP-palvelin)</td>
                                    <td>@if ($dnsmasqRunning) 
                                        <span class="icon-text has-text-success">
                                            <span class="icon">
                                                <svg width="24px" height="24px" fill="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM10.2426 14.4142L17.3137 7.34315L18.7279 8.75736L10.2426 17.2426L6 13L7.41421 11.5858L10.2426 14.4142Z" />
                                                </svg>
                                            </span>
                                            <span>Toiminnassa</span>
                                        </span>
                                        @else 
                                        <span class="icon-text has-text-danger">
                                            <span class="icon">
                                                <svg width="24px" height="24px" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm3.71,12.29a1,1,0,0,1,0,1.42,1,1,0,0,1-1.42,0L12,13.42,9.71,15.71a1,1,0,0,1-1.42,0,1,1,0,0,1,0-1.42L10.58,12,8.29,9.71A1,1,0,0,1,9.71,8.29L12,10.58l2.29-2.29a1,1,0,0,1,1.42,1.42L13.42,12Z"></path>
                                                </svg>
                                            </span>
                                            <span>Ei toiminnassa</span>
                                        </span>
                                        @endif
                                    </td>
                                    <td><button class="button is-small is-primary" wire:click="viewLogDnsmasq()">Katso lokia</button></td>
                                </tr>
                                <tr>
                                    <td>rpiboot (USB-tiedostopalvelin)</td>
                                    <td>@if ($rpibootRunning) 
                                        <span class="icon-text has-text-success">
                                            <span class="icon">
                                                <svg width="24px" height="24px" fill="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM10.2426 14.4142L17.3137 7.34315L18.7279 8.75736L10.2426 17.2426L6 13L7.41421 11.5858L10.2426 14.4142Z" />
                                                </svg>
                                            </span>
                                            <span>Toiminnassa</span>
                                        </span>
                                        @else 
                                        <span class="icon-text has-text-danger">
                                            <span class="icon">
                                                <svg width="24px" height="24px" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm3.71,12.29a1,1,0,0,1,0,1.42,1,1,0,0,1-1.42,0L12,13.42,9.71,15.71a1,1,0,0,1-1.42,0,1,1,0,0,1,0-1.42L10.58,12,8.29,9.71A1,1,0,0,1,9.71,8.29L12,10.58l2.29-2.29a1,1,0,0,1,1.42,1.42L13.42,12Z"></path>
                                                </svg>
                                            </span>
                                            <span>Ei toiminnassa</span>
                                        </span>
                                        @endif
                                    </td>
                                    <td><button class="button is-small is-primary" wire:click="viewLogRpiboot()">Katso lokia</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="column is-full">
            <div class="container card">
                <div class="card-header">
                    <p class="card-header-title">DHCP-palvelin - Staattiset IP-osoitteen määritykset</p>
                </div>
                <div class="card-content">
                    <button class="button mb-2" wire:click="addStaticIP()">Lisää uusi määritys</button>
                    <div class="table-container">
                        <table class="table is-fullwidth">
                            <thead>
                                <tr class="is-primary">
                                    <th class="has-text-white">IP</th>
                                    <th class="has-text-white">MAC-osoite</th>
                                    <th class="has-text-white">Toiminnot</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($hosts as $h)
                                <tr>
                                    <td>{{ $h->ip }}</td>
                                    <td>{{ $h->mac }}</td>
                                    <td>
                                        <button class="button is-small is-danger" wire:click="deleteStaticIP({{ $h->id }})">Poista</button>
                                    </td>
                                </tr>
                                @empty
                                <tr><td class="has-text-centered" colspan="3">Ei merkintöjä</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>