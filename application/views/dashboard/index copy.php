<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="container mt-5">
    <h2>Dashboard</h2>
    <p>Location: <?= $city ?>, <?= $region ?></p>
    <a href="<?= base_url('projects/create') ?>" class="btn btn-success mb-3">+ New Project</a>
    <a href="<?= base_url('logout') ?>" class="btn btn-secondary mb-3">Logout</a>

    <?php foreach ($projects as $project): ?>
    <div class="card mb-3">
        <div class="card-header">
            <strong><?= $project->title ?></strong>
            <a href="<?= base_url('projects/edit/'.$project->id) ?>" class="btn btn-sm btn-warning float-end">Edit</a>
        </div>
        <div class="card-body">
            <p><?= $project->description ?></p>
            <form class="task-form" data-project="<?= $project->id ?>">
                <div class="input-group mb-2">
                    <input type="text" name="title" class="form-control" placeholder="Add Task" required>
                    <input type="hidden" name="project_id" value="<?= $project->id ?>">
                    <button class="btn btn-primary">Add</button>
                </div>
            </form>
            <ul class="task-list" id="task-list-<?= $project->id ?>">
                <?php
                    $CI =& get_instance();
                    $CI->load->model('Task_model');
                    $tasks = $CI->Task_model->getByProject($project->id);
                    foreach ($tasks as $task):
                ?>
                <li><?= $task->title ?> <a href="<?= base_url('tasks/delete/'.$task->id) ?>"
                        class="btn btn-sm btn-danger">Delete</a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php endforeach; ?>

    <script>
    $(".task-form").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: "<?= base_url('tasks/store') ?>",
            type: "POST",
            data: form.serialize(),
            success: function() {
                let title = form.find("input[name='title']").val();
                let listId = "#task-list-" + form.data("project");
                $(listId).append("<li>" + title + "</li>");
                form[0].reset();
            }
        });
    });
    </script>
</body>

</html>