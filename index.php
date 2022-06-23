<?php require_once 'vendor/db.php'; ?>
<?php require_once('header.php') ?>

<?php if (!empty($_SESSION['logged_user'])) { ?>
    <?php if ($_GET['search'] == null) { ?>
        <?php include 'src/charts.php'; ?>
        <div><H1 style="margin-left: 10px">ТОП 10 ТРЕКОВ</H1></div>
        <?php /** @var  $tracks */
        foreach ($tracks as $track) {
            $data = $track->data;
            ?>
            <div style="margin-top: 20px">
                <iframe frameborder="0" style="border:none;width:100%;height:180px;" width="100%" height="180"
                        src="https://music.yandex.ru/iframe/#track/<?= $data->track->id ?>/<?= $data->track->albums[0]->id ?>">
                    Слушайте <a
                            href='https://music.yandex.ru/album/<?= $data->track->albums[0]->id ?>/track/<?= $data->track->id ?>'>ЦОЙ</a>
                    —
                    <a
                            href='https://music.yandex.ru/artist/<?= $data->track->artists[0]->id ?>'>Ночные
                        Снайперы</a>
                </iframe>
            </div>
        <?php } ?>
    <?php } else { ?>
        <?php include 'src/search.php'; ?>
        <?php /** @var  $tracks_search */
        foreach ($tracks_search as $track) { ?>
            <div style="margin-top: 20px">
                <iframe frameborder="0" style="border:none;width:100%;height:180px;" width="100%" height="180"
                        src="https://music.yandex.ru/iframe/#track/<?= $track->id ?>/<?= $track->albums[0]->id ?>">
                    Слушайте
                    <a
                            href='https://music.yandex.ru/album/<?= $track->albums[0]->id ?>/track/<?= $track->id ?>'>ЦОЙ</a>
                    —
                    <a
                            href='https://music.yandex.ru/artist/<?= $track->artists[0]->id ?>'>Ночные Снайперы</a>
                </iframe>
            </div>
        <?php } ?>
    <?php } ?>
<?php } else { ?>
        <script>
            window.location.replace('login.php')
        </script>
<?php } ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="asset/js/script.js"></script>
<script src="asset/js/wishlist.js"></script>