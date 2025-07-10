<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <h2>Edit Project</h2>
    <form method="post" action="<?= base_url('projects/update/'.$project->id) ?>">
        <div class="mb-3">
            <input type="text" name="title" value="<?= $project->title ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <textarea name="description" class="form-control"><?= $project->description ?></textarea>
        </div>
        <button class="btn btn-warning">Update</button>
    </form>
</body>

</html>