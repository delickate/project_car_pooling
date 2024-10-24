<!DOCTYPE html>
<html>
<head>
    <title>Ride Details</title>
</head>
<body>
    <h2>Ride Details</h2>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <tr>
            <th>ID</th>
            <th>Driver ID</th>
            <th>Rider ID</th>
            <th>From Location</th>
            <th>To Location</th>
            <th>Trip Type</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($ride_details as $ride_detail): ?>
            <tr>
                <td><?php echo $ride_detail->id; ?></td>
                <td><?php echo $ride_detail->driver_idfk; ?></td>
                <td><?php echo $ride_detail->rider_idfk; ?></td>
                <td><?php echo $ride_detail->from_location_idfk; ?></td>
                <td><?php echo $ride_detail->to_location_idfk; ?></td>
                <td><?php echo $ride_detail->trip_type; ?></td>
                <td>
                    <a href="<?php echo site_url('ridedetailcontroller/edit/' . $ride_detail->id); ?>">Edit</a>
                    <a href="<?php echo site_url('ridedetailcontroller/delete/' . $ride_detail->id); ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div><?php echo $pagination; ?></div>
</body>
</html>
