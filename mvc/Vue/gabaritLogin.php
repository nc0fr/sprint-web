<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="Vue/css/daisyui.css">
    <script src="Vue/js/tailwindcss.js"></script>
    <title>Sprint Bank | Login</title>
    <meta charset="utf-8">
</head>
<body class="hero min-h-screen bg-base-200">
<main class="hero-content text-center">
    <div class="max-w-md">
        <h2 class="text-base-content text-5xl">
            Connectez-vous
        </h2>
        <form method="post" class="my-6 gap-4">
            <label>
                <input type="text"
                       name="login"
                       placeholder="Nom d'utilisateur"
                       class="m-2 input input-bordered input-primary w-full max-w-xs"
                       required>
            </label>
            <label>
                <input type="password"
                       name="mdp"
                       placeholder="Mot de passe"
                       class="m-2 input input-bordered input-primary w-full max-w-xs"
                       required>
            </label>
            <input type="submit"
                   name="connexion"
                   value="Connexion"
                   class="m-4 btn btn-active btn-neutral text-neutral hover:text-neutral-content w-full max-w-xs">
        </form>
    </div>
</main>
<?php if (!empty($contenu)) {
    echo $contenu;
} ?>
</body>
</html>

