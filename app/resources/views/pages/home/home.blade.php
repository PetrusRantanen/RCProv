<div>
    <div class="container">
            <div class="card">
                <div class="card-header">
                    <p class="card-header-title">
                        Viimeiset 100 käyttöönottolokin merkintää
                    </p>
                </div>
                <div class="card-content">
                    <div class="content">
                        <div class="table-container">
                            <table class="table is-narrow is-fullwidth">
                                <thead>
                                    <tr class="is-primary">
                                        <th class="has-text-white">Kortti</th>
                                        <th class="has-text-white">Sarjanumero</th>
                                        <th class="has-text-white">Lokiviesti</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($log as $l)
                                    @if ($l->loglevel == 'error')<tr class="has-background-danger">@else <tr> @endif 
                                        <td>{{ $l->board }}</td>
                                        <td>{{ $l->cm }}</td>
                                        <td>{!! nl2br(e($l->created_at->toTimeString().' '.$l->msg), false) !!}</td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="3" class="has-text-centered">Lokimerkintöjä ei löytynyt.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>