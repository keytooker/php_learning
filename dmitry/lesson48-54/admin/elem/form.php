<form method="POST">
    <p>
        <label name="title">title:</label>
        <input name="title" value="<?=$title?>" placeholder="type title">
    </p><p>
        <label name="url">url:</label>
        <input name="url" value="<?= $url ?>" placeholder="type url">
    </p><p>
        <label name="text">text:</label>
        <textarea name="text"><?= $text ?></textarea>
    </p><p>

        <input type="submit">
    </p>
</form>