<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <h2>Create Project</h2>
    <form method="post" action="<?= base_url('projects/store') ?>">
        <div class="mb-3">
            <input type="text" name="title" class="form-control" placeholder="Title" required>
        </div>
        <div class="mb-3">
            <textarea name="description" class="form-control" placeholder="Description"></textarea>
        </div>
        <button class="btn btn-success">Save</button>
    </form>
</body>

</html>