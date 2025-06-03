<div class="mb-3">
    <label for="title" class="form-label">Titre *</label>
    <input type="text" name="title" id="title" value="{{ old('title', $offer?->title) }}" class="form-control" required>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description *</label>
    <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description', $offer?->description) }}</textarea>
</div>

<div class="mb-3">
    <label for="domain" class="form-label">Domaine *</label>
    <input type="text" name="domain" id="domain" value="{{ old('domain', $offer?->domain) }}" class="form-control" required>
</div>

<div class="mb-3">
    <label for="type" class="form-label">Type *</label>
    <select name="type" id="type" class="form-select" required>
        <option value="Stage" {{ old('type', $offer?->type) == 'Stage' ? 'selected' : '' }}>Stage</option>
        <option value="CDI" {{ old('type', $offer?->type) == 'CDI' ? 'selected' : '' }}>CDI</option>
        <option value="CDD" {{ old('type', $offer?->type) == 'CDD' ? 'selected' : '' }}>CDD</option>
    </select>
</div>

<div class="mb-3">
    <label for="location" class="form-label">Lieu *</label>
    <input type="text" name="location" id="location" value="{{ old('location', $offer?->location) }}" class="form-control" required>
</div>

<div class="mb-3">
    <label for="deadline" class="form-label">Date limite *</label>
    <input type="date" name="deadline" id="deadline" value="{{ old('deadline', $offer?->deadline ? $offer->deadline->format('Y-m-d') : null) }}" class="form-control" required>
</div>
