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
    <p>Location: <?= isset($city) ? $city : 'Unknown' ?>, <?= isset($region) ? $region : 'Unknown' ?></p>
    <a href="<?= base_url('projects/create') ?>" class="btn btn-success mb-3">+ New Project</a>
    <a href="<?= base_url('logout') ?>" class="btn btn-secondary mb-3">Logout</a>

    <?php foreach ($projects as $project): ?>
    <div class="card mb-3">
        <div class="card-header">
            <strong><?= $project->title ?></strong>
            <a href="<?= base_url('projects/delete/' . $project->id) ?>" class="btn btn-sm btn-danger float-end ms-2"
                onclick="return confirm('Are you sure you want to delete this project?')">Delete</a>
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
                <li data-id="<?= $task->id ?>">
                    <span class="task-title"><?= $task->title ?></span>
                    <input type="text" class="edit-input form-control d-none mb-2" value="<?= $task->title ?>" />
                    <button class="btn btn-sm btn-info edit-task">Edit</button>
                    <button class="btn btn-sm btn-success save-task d-none">Save</button>
                    <a href="<?= base_url('tasks/delete/'.$task->id) ?>" class="btn btn-sm btn-danger">Delete</a>
                </li>
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
                location.reload(); // Refresh to show new task
            }
        });
    });

    $(document).on('click', '.edit-task', function() {
        let li = $(this).closest('li');
        li.find('.task-title').addClass('d-none');
        li.find('.edit-input').removeClass('d-none');
        li.find('.edit-task').addClass('d-none');
        li.find('.save-task').removeClass('d-none');
    });

    $(document).on('click', '.save-task', function() {
        let li = $(this).closest('li');
        let taskId = li.data('id');
        let newTitle = li.find('.edit-input').val();

        $.ajax({
            url: "<?= base_url('tasks/update') ?>",
            type: "POST",
            data: {
                id: taskId,
                title: newTitle
            },
            success: function() {
                location.reload();
            }
        });
    });
    </script>
</body>

</html>