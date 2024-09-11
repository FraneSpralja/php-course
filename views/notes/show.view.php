<?php require view_path("partials/head.php"); ?>
<?php require view_path("partials/nav.php"); ?>
<?php require view_path("partials/banner.php"); ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <p class="mb-6">
            <a href="/notes" class="text-blue-500 underline"> go back...</a>
        </p>
        <p><?= htmlspecialchars($note['body']) ?></p>
        <p class="mt-4 inline-block me-4">
            <a href="/notes/edit?id=<?= $note['id'] ?>"
                class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</a>
        </p>
        <form class="mt-4 inline-block" method="POST">
            <input type="hidden" name="id" value="<?= $note['id'] ?>">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="text-small text-red-500">Delete</button>
        </form>
    </div>
</main>

<?php require view_path("partials/foot.php"); ?>