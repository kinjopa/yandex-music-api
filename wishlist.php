<?php require_once 'vendor/db.php'; ?>
<?php require_once('header.php') ?>

<?php if (!empty($_SESSION['logged_user'])) { ?>
    <?php include 'src/get_user_likes.php'; ?>
    <div><H1 style="margin-left: 10px">Понравившиеся плейлисты</H1></div>
    <?php /** @var  $playlist */
    foreach ($playlist as $track) {
        ?>
        <div style="margin-top: 20px">
            <iframe frameborder="0" style="border:none;width:100%;height:450px;" width="100%" height="450"
                    src="https://music.yandex.ru/iframe/#playlist/<?= $track->uid ?>/<?= $track->kind ?>">Слушайте <a
                        href='https://music.yandex.ru/users/<?= $track->uid ?>/playlists/<?= $track->kind ?>'>test</a> — <a
                        href='https://music.yandex.ru/users/<?= $track->uid ?>'><?= $_SESSION['logged_user']['email'] ?></a> на Яндекс
                Музыке
            </iframe>
        </div>
    <?php } ?>
    <div><H1 style="margin-left: 10px">Понравившиеся песни</H1></div>
    <?php /** @var  $tracks */
    foreach ($tracks as $track) {
        ?>
        <div style="margin-top: 20px">
            <iframe frameborder="0" style="border:none;width:100%;height:180px;" width="100%" height="180"
                    src="https://music.yandex.ru/iframe/#track/<?= $track->id ?>/<?= $track->albumId ?>">
                Слушайте <a
                        href='https://music.yandex.ru/album/<?= $track->albumId  ?>/track/<?= $track->id  ?>'>ЦОЙ</a>
                —
            </iframe>
        </div>
    <?php } ?>
<?php } else { ?>
    <script>
        window.location.replace('login.php')
    </script>
<?php } ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="asset/js/script.js"></script>
<script src="asset/js/wishlist.js"></script>