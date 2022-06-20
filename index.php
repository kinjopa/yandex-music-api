<?php require 'vendor/db.php'; ?>
<?php require_once('src/charts.php') ?>
<?php require_once('src/search.php') ?>
<?php require_once('header.php') ?>
<?php if ($_GET['search'] == null) { ?>
<div><H1 style="margin-left: 10px">ТОП 20 ТРЕКОВ GLOBAL</H1></div>
    <div class="player">
        <div class="player__header">
            <div class="player__img player__img--absolute slider">
                <button class="player__button player__button--absolute--nw playlist">
                    <img src="http://physical-authority.surge.sh/imgs/icon/playlist.svg" alt="playlist-icon">
                </button>
                <button class="player__button player__button--absolute--center play">
                    <img src="http://physical-authority.surge.sh/imgs/icon/play.svg" alt="play-icon">
                    <img src="http://physical-authority.surge.sh/imgs/icon/pause.svg" alt="pause-icon">
                </button>
                <div class="slider__content">
                    <?php  foreach ($data['tracks'] as $track) { ?>
                    <img class="img slider__img" src="<?= $track['images']['coverarthq'] ?>" alt="cover">
                    <?php } ?>
                </div>
            </div>
            <div class="player__controls">
                <button class="player__button back">
                    <img class="img" src="http://physical-authority.surge.sh/imgs/icon/back.svg" alt="back-icon">
                </button>
                <p class="player__context slider__context">
                    <strong class="slider__name"></strong>
                    <span class="player__title slider__title"></span>
                </p>
                <button class="player__button next">
                    <img class="img" src="http://physical-authority.surge.sh/imgs/icon/next.svg" alt="next-icon">
                </button>
                <div class="progres">
                    <div class="progres__filled"></div>
                </div>
            </div>
        </div>

        <ul class="player__playlist list">
            <?php  foreach ($data['tracks'] as $track) { ?>
            <li class="player__song">
                <img class="player__img img" src="<?= $track['images']['coverarthq'] ?>" alt="cover">
                <p class="player__context">
                    <b class="player__song-name" style="color: black"><?= $track['title'] ?></b>
                    <span class="flex">
            <span class="player__title" style="color: black"><?= $track['subtitle'] ?></span>
            <span class="player__song-time"></span>
          </span>
                </p>
                <audio class="audio" src="<?= $track['hub']['actions']['1']['uri'] ?>"></audio>
            </li>
            <?php } ?>
        </ul>
    </div>
<?php } else {?>
    <div><H1 style="margin-left: 10px">Поиск по запросу: <?= $_GET['search'] ?> </H1></div>
    <div class="player">
        <div class="player__header">
            <div class="player__img player__img--absolute slider">
                <button class="player__button player__button--absolute--nw playlist">
                    <img src="http://physical-authority.surge.sh/imgs/icon/playlist.svg" alt="playlist-icon">
                </button>
                <button class="player__button player__button--absolute--center play">
                    <img src="http://physical-authority.surge.sh/imgs/icon/play.svg" alt="play-icon">
                    <img src="http://physical-authority.surge.sh/imgs/icon/pause.svg" alt="pause-icon">
                </button>
                <div class="slider__content">
                    <?php  foreach ($data_search['tracks']['hits'] as $track) { ?>
                        <img class="img slider__img" src="<?= $track['track']['images']['coverarthq'] ?>" alt="cover">
                    <?php } ?>
                </div>
            </div>
            <div class="player__controls">
                <button class="player__button back">
                    <img class="img" src="http://physical-authority.surge.sh/imgs/icon/back.svg" alt="back-icon">
                </button>
                <p class="player__context slider__context">
                    <strong class="slider__name"></strong>
                    <span class="player__title slider__title"></span>
                </p>
                <button class="player__button next">
                    <img class="img" src="http://physical-authority.surge.sh/imgs/icon/next.svg" alt="next-icon">
                </button>
                <div class="progres">
                    <div class="progres__filled"></div>
                </div>
            </div>
        </div>

        <ul class="player__playlist list">
            <?php  foreach ($data_search['tracks']['hits'] as $track) { ?>
                <li class="player__song">
                    <img class="player__img img" src="<?= $track['track']['images']['coverarthq'] ?>" alt="cover">
                    <p class="player__context">
                        <b class="player__song-name" style="color: black"><?= $track['track']['title'] ?></b>
                        <span class="flex">
            <span class="player__title" style="color: black"><?= $track['track']['subtitle'] ?></span>
            <span class="player__song-time"></span>
          </span>
                    </p>
                    <audio class="audio" src="<?= $track['track']['hub']['actions']['1']['uri'] ?>"></audio>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="asset/js/script.js"></script>
