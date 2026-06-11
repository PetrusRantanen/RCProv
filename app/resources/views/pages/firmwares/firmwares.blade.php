
<div>
    <div class="container">
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
                    <button wire:click="update()" wire:loading.class="is-loading" wire:loading.attr="disabled" class="button">Lataa uusimmat laiteohjelmistot GitHubista</button>
                </div>
            </div>

            <div class="column is-full">
                <div class="container box">
                    <div class="card">
                        <div class="card-header">
                            <p class="card-header-title">Saatavilla olevat laitteisto-ohjelmistot</p>
                       </div>

                        <div class="card-content">
                           <div class="content">
                                <div class="table-container">
                                    <table class="table is-narrow is-fullwidth">
                                        <thead>
                                            <tr class="is-primary">
                                                <th class="has-text-white">Nimi</th>
                                                <th class="has-text-white">Kanava</th>
                                            </tr>
                                        </thead>

                                         <tbody>
                                            @forelse($firmware as $f)
                                            <tr>
                                                <td>{{ $f->name }}</td>
                                                <td>{{ $f->channel }}</td>
                                            </tr>
                                            @empty
                                            <tr><td class="has-text-centered" colspan="2">Ei laiteohjelmistomerkintöjä.</td></tr>
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
    </div>
</div>