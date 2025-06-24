<?php
$title = "Ajouter un visiteur";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-xl p-6">
        <h1 class="text-2xl font-bold mb-6 text-center"><?= $title ?></h1>

        <?php if (isset($errors) && $errors->any()): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    <?php foreach ($errors->all() as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="/visiteurs" class="bg-white p-6 rounded-lg shadow-md space-y-4">
            <?= csrf_field() ?>

            <div>
                <label for="cni" class="block text-sm font-medium text-gray-700">CNI</label>
                <input type="text" name="cni" id="cni" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="nom" id="nom" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                    <input type="text" name="prenom" id="prenom" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="date" id="date" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label for="heure_arrive" class="block text-sm font-medium text-gray-700">Heure d'arrivée</label>
                <input type="time" name="heure_arrive" id="heure_arrive" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label for="motif" class="block text-sm font-medium text-gray-700">Motif de la visite</label>
                <input type="text" name="motif" id="motif" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label for="locataire_id" class="block text-sm font-medium text-gray-700">Locataire visité</label>
                <select name="locataire_id" id="locataire_id" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <?php foreach ($locataires as $locataire): ?>
                        <option value="<?= $locataire->id ?>">
                            <?= $locataire->nom ?> <?= $locataire->prenom ?> - Chambre <?= $locataire->numero_etage ?>.<?= $locataire->numero_chambre ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Enregistrer le visiteur
                </button>
            </div>
        </form>
    </div>
</body>
</html>
