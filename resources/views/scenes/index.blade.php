<x-layout titre="Liste des Scènes">
    <style>
        .custom-button {
            background-color: #f8f9fa !important;
            color: #343a40 !important;
            padding: 5px 15px !important;
            border: 1px solid #ced4da !important;
            border-radius: 10px !important;
            cursor: pointer !important;
        }

        .custom-button:hover {
            background-color: #e9ecef !important;
        }
        .col:hover {
            transform: scale(1.01);
        }
    </style>

    <div>
    <h1>Liste des Scènes</h1>
        <form action="{{route('scenes.index')}}" method="get">
            <div class="input-group">
            <div class="mb-3">
            <select name="cat" class="form-select form-control bg-white">
                <option value="All" @if($cat == 'All') selected @endif>-- Toutes équipes --</option>
                @foreach($equipes as $equipe)
                    <option value="{{$equipe}}" @if($cat == $equipe) selected @endif>{{$equipe}}</option>
                @endforeach
            </select>
            </div>
                <input type="submit" class="custom-button" value="Filtrer"><br>
            </div>
        </form>

        <div class="row row-cols-1 row-cols-md-3 g-4 mt-1">
            @foreach ($scenes as $scene)
                <a href="{{ route('scenes.show', $scene->id) }}" class="text-decoration-none">
                <div class="col mb-4">
                <div class="card bg-white border shadow">
                    <img src="{{ asset("storage/" . $scene->vignetteImage) }}" class="card-img-top img-fluid" alt="Vignette de la Scène">
                    <div class="card-body">
                        <h5 class="card-title">{{ $scene->nom }}</h5>
                        <p class="card-text">
                            <strong>Équipe:</strong> {{ $scene->equipe }}<br>
                            <strong>Date d'Ajout:</strong> {{ $scene->created_at }}<br>
                        </p>
                    </div>
                </div>
                </div>
                </a>
            @endforeach
        </div>
    </div>
</x-layout>

