<?php
$title = "Filtrage des visiteurs";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6"><?= htmlspecialchars($title) ?></h1>

        <!-- Filtres -->
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <form method="GET" action="<?= route('visiteurs.filtre') ?>" class="flex items-center space-x-4">
                <div>
                    <label for="statut" class="block text-sm font-medium text-gray-700">Statut :</label>
                    <select name="statut" id="statut" class="mt-1 block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="tous" <?= $statutSelectionne === 'tous' ? 'selected' : '' ?>>Tous les visiteurs</option>
                        <option value="present" <?= $statutSelectionne === 'present' ? 'selected' : '' ?>>Visiteurs présents</option>
                        <option value="parti" <?= $statutSelectionne === 'parti' ? 'selected' : '' ?>>Visiteurs partis</option>
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Filtrer
                </button>
            </form>
        </div>

        <!-- Tableau des visiteurs -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Visiteur</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Locataire</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Arrivée</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Départ</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($visiteurs as $visiteur): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?= htmlspecialchars($visiteur->nom.' '.$visiteur->prenom) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?= htmlspecialchars($visiteur->locataire->nom.' '.$visiteur->locataire->prenom) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?= date('d/m/Y', strtotime($visiteur->date)) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?= date('H:i', strtotime($visiteur->heure_arrive)) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?= $visiteur->heure_depart ? date('H:i', strtotime($visiteur->heure_depart)) : '-' ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                <?= $visiteur->heure_depart ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                <?= $visiteur->heure_depart ? 'Parti' : 'Présent' ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            <?= $visiteurs->appends(['statut' => $statutSelectionne])->links() ?>
        </div>
    </div>
</body>
</html>