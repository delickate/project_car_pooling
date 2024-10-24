<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Types</title>
</head>
<body>
    <h2>Vehicle Types</h2>
    
     <table id="example" class="table table-striped table-bordered" style="width:100%">
        <tr>
            <th>ID</th>
            <th>Vehicle Name</th>
            <th>Capacity</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($vehicle_types as $vehicle_type): ?>
            <tr>
                <td><?php echo $vehicle_type->id; ?></td>
                <td><?php echo $vehicle_type->vehicle_name; ?></td>
                <td><?php echo $vehicle_type->capacity; ?></td>
                <td><?php echo $vehicle_type->status; ?></td>
                <td>
                    <a href="<?php echo site_url('vehicletypecontroller/edit/' . $vehicle_type->id); ?>">Edit</a>
                    <a href="<?php echo site_url('vehicletypecontroller/delete/' . $vehicle_type->id); ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div><?php echo $pagination; ?></div>
</body>
</html>
