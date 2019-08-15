<form method="get" action="/">
    <div class="form-row align-items-center">
        <div class="col-6">
            <label class="sr-only" for="name">Name</label>
            <input type="hidden" name="filter" value="name">
            <input type="text" class="form-control mb-2" name="value" id="name" placeholder="Name">
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-2">Search by name</button>
        </div>
    </div>
</form>
<form method="get" action="/">
    <div class="form-row align-items-center">
        <div class="col-6">
            <label class="sr-only" for="interest">Interest</label>
            <input type="hidden" name="filter" value="interest">
            <input type="text" class="form-control mb-2" name="value" id="interest" placeholder="Interest">
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-2">Search by interest</button>
        </div>
    </div>
</form>
<form>
    <div class="form-row align-items-center">
        <div class="col-6">
        </div>
        <div class="col-auto">
            <a class="btn btn-primary mb-2" href="/" role="button">Search all users</a>
        </div>
    </div>
</form>

<div class="row">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Emails</th>
            <th scope="col">Photos</th>
            <th scope="col">Places Of Work</th>
            <th scope="col">Interests</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($responseData as $userData): ?>
        <tr>
            <th scope="row"><?= $userData['name'] ?></th>
            <td>
                <?php foreach ($userData['emails'] as $email): ?>
                    <p><?= $email ?></p>
                <?php endforeach;?>
            </td>
            <td>
                <?php foreach ($userData['photos'] as $photo): ?>
                    <p><?= $photo ?></p>
                <?php endforeach;?>
            </td>
            <td>
                <?php foreach ($userData['placesOfWork'] as $place): ?>
                    <p><?= $place ?></p>
                <?php endforeach;?>
            </td>
            <td>
                <?php foreach ($userData['interests'] as $interest): ?>
                    <p><?= $interest ?></p>
                <?php endforeach;?>
            </td>
        </tr>
            <?php endforeach;?>
    </table>
</div>