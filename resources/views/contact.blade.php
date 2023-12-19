<x-layout titre="Contact">
    <div class="container mt-5 bg-secondary rounded">
        <h1 class="mb-3 card-header">Contactez-nous</h1>
        <form method="post" action="{{ route('contact.submit') }}">
            @csrf
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control bg-white" id="prenom" name="prenom" required>
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control bg-white" id="nom" name="nom" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Adresse Email</label>
                <input type="email" class="form-control bg-white" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control bg-white" id="message" name="message" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary mb-3">Envoyer</button>
        </form>
    </div>
</x-layout>
