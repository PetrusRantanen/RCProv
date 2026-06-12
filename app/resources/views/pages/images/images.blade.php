
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

    <div class="columns is-multiline">
        <div class="column is-full">
            <div class="container box">
                <button wire:click="create()" class="button">Lataa uusi levykuva</button>
                 @if($modalOpen)
                    @include('pages.images.addimage')
                @endif
            </div>
        </div>

        <div class="column is-full">
            <div class="container box">

                <div class="card">
                    <div class="card-header">
                        <p class="card-header-title">Ladatut levykuvat</p>
                    </div>
                    <div class="card-content">
                        <div class="table-container">
                            <table class="table is-narrow is-fullwidth">
                                <thead>
                                    <tr class="is-primary">
                                        <th class="has-text-white">Tiedostonimi</th>
                                        <th class="has-text-white">Tiedostokoko</th>
                                        <th class="has-text-white">SHA256-tunniste</th>
                                        <th class="has-text-white">Toiminnot</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($images as $i)
                                        <tr>
                                            <td>
                                                <nobr>{{ $i->filename }}</nobr><br />
                                                <nobr><span class="has-text-weight-bold is-italic">Lisätty:</span> {{ date_format($i->created_at, "d.m.Y") }}</i></nobr>
                                            </td>
                                            <td>
                                                <nobr>Pakattu: {{ number_format($i->filesize()/1000000000,1) }}  GB</nobr><br />
                                                <nobr>{{ $i->uncompressed_size ? number_format($i->uncompressed_size/1000000000,1) : 'tuntematon' }} GB</nobr>
                                            </td>
                                            <td>
                                                <nobr>Pakattu: {{ $i->sha256 ? $i->sha256 : "Lasketaan tunnistetta parhaillaan..." }}</nobr><br />
                                                <nobr>{{ $i->uncompressed_sha256 ? $i->uncompressed_sha256 : "Lasketaan tunnistetta parhaillaan..." }}</nobr>
                                            </td>
                                            <td>
                                                <button wire:click="delete({{$i->id}})" class="button is-small is-danger">Poista</button>
                                            </td>
                                        </tr>
                                     @empty
                                        <tr><td colspan="4">Ei merkintöjä</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>