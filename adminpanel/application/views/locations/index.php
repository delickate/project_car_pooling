
    <h2>Locations</h2>
    
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($locations as $location): ?>
            <tr>
                <td><?php echo $location->id; ?></td>
                <td><?php echo $location->name; ?></td>
                <td>
                    <a href="<?php echo site_url('locationcontroller/edit/' . $location->id); ?>">Edit</a>
                    <a href="<?php echo site_url('locationcontroller/delete/' . $location->id); ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div><?php echo $pagination; ?></div>

