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

    <div class="row">
        <?php foreach ($projects as $project): ?>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 d-flex justify-content-between align-items-center">
                        <?= $project->title ?>
                        <span class="badge bg-light text-dark"><?php
                        $CI =& get_instance();
                        $CI->load->model('Task_model');
                        echo count($CI->Task_model->getByProject($project->id)) ?>
                            Tasks</span>
                    </h5>
                </div>
                <div class="card-body">
                    <p><?= $project->description ?></p>
                    <?php 
                    $CI =& get_instance();
                    $CI->load->model('Task_model');
                    $tasks = $CI->Task_model->getByProject($project->id); ?>
                    <?php foreach ($tasks as $task): ?>
                    <div class="border rounded p-2 mb-2 bg-light">
                        <div class="task-item" data-id="<?= $task->id ?>">
                            <span class="task-title"><?= $task->title ?></span>
                            <input type="text" class="edit-input form-control d-none mt-2"
                                value="<?= $task->title ?>" />

                            <div class="mt-2 d-flex justify-content-between">
                                <button class="btn btn-sm btn-outline-info edit-task">Edit</button>
                                <button class="btn btn-sm btn-success save-task d-none">Save</button>
                                <a href="<?= base_url('tasks/delete/'.$task->id) ?>"
                                    class="btn btn-sm btn-outline-danger">Delete</a>
                            </div>
                        </div>

                    </div>
                    <?php endforeach; ?>

                    <form class="task-form mt-3" data-project="<?= $project->id ?>">
                        <div class="input-group">
                            <input type="text" name="title" class="form-control" placeholder="Add Task" required>
                            <input type="hidden" name="project_id" value="<?= $project->id ?>">
                            <button class="btn btn-sm btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>


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
        let container = $(this).closest('.task-item');
        container.find('.task-title').addClass('d-none');
        container.find('.edit-input').removeClass('d-none');
        container.find('.edit-task').addClass('d-none');
        container.find('.save-task').removeClass('d-none');
    });

    $(document).on('click', '.save-task', function() {
        let container = $(this).closest('.task-item');
        let id = container.data('id');
        let newTitle = container.find('.edit-input').val();

        $.post("<?= base_url('tasks/update') ?>", {
            id: id,
            title: newTitle
        }, function() {
            location.reload();
        });
    });
    </script>
</body>

</html>