"use strict";

let doc = document;

// pleer container
let pleer = doc.createElement('div');
pleer.setAttribute('id', 'pleer');

// track name
let track_name = doc.createElement('div');
track_name.setAttribute('class', 'pleer__track_name');

// buttons row
let buttons_row = doc.createElement('div');
buttons_row.setAttribute('class', 'pleer__buttons_row');

// play/pause button
let play = doc.createElement('button');
play.setAttribute('class', 'pleer__play');
let play_icon = doc.createElement('i');
play_icon.setAttribute('class','pleer__play_icon fa fa-play');
play_icon.setAttribute('aria-hidden', 'true');
play.append(play_icon);
let pause_icon = doc.createElement('i');
pause_icon.setAttribute('class','pleer__pause_icon fa fa-pause');
pause_icon.setAttribute('aria-hidden', 'true');
let play_pause = false;

// start timer
let start_time = doc.createElement('output');
start_time.setAttribute('class', 'pleer__start_time');
start_time.insertAdjacentHTML('afterbegin', '00:00');

// remain timer
let end_time = doc.createElement('output');
end_time.setAttribute('class', 'pleer__end_time');
end_time.insertAdjacentHTML('afterbegin', '00:00');

// timeline
let timeline = doc.createElement('input');
timeline.setAttribute('type', 'range');
timeline.setAttribute('class', 'pleer__timeline');
timeline.setAttribute('min', '0');
timeline.setAttribute('value', '0');

// track 
let track = new Audio();
let duration = track.duration;

// play speed
let speed = doc.createElement('select');
speed.setAttribute('class', 'pleer__speed');
speed.insertAdjacentHTML('afterbegin', '<option value="0.5">0.5x</option><option value="1" selected>1x</option><option value="1.25">1.25x</option><option value="1.5">1.5x</option><option value="1.75">1.75x</option><option value="2">2x</option><option value="2.5">2.5x</option>')

// volume
let volume_button = doc.createElement('button');
volume_button.setAttribute('class', 'pleer__volume_button');
let volume_icon = doc.createElement('i');
volume_icon.setAttribute('class','pleer__volume_icon fa fa-volume-up');
volume_icon.setAttribute('aria-hidden', 'true');
let middle_volume_icon = doc.createElement('i');
middle_volume_icon.setAttribute('class','pleer__middle_volume_icon fa fa-volume-down');
middle_volume_icon.setAttribute('aria-hidden', 'true');
let mute_icon = doc.createElement('i');
mute_icon.setAttribute('class','pleer__mute_icon fa fa-volume-off');
mute_icon.setAttribute('aria-hidden', 'true');
let volume_container = doc.createElement('div');
volume_container.setAttribute('class', 'pleer__volume_container');
let volume = doc.createElement('input');
volume.setAttribute('class', 'pleer__volume');
volume.setAttribute('type', 'range');
volume.setAttribute('min', '0');
volume.setAttribute('max', '100');
volume.setAttribute('value', '100');
volume_container.append(volume);
volume_button.append(volume_icon);

// download button
let download_button = doc.createElement('button');
download_button.setAttribute('class', 'pleer__download_button');
let download_icon = doc.createElement('i');
download_icon.setAttribute('class','pleer__download_icon fa fa-download');
download_icon.setAttribute('aria-hidden', 'true');
download_button.append(download_icon);

// upload button
let upload_button = doc.createElement('button');
upload_button.setAttribute('class', 'pleer__upload_button');
let upload_icon = doc.createElement('i');
upload_icon.setAttribute('class','pleer__upload_icon fa fa-upload');
upload_icon.setAttribute('aria-hidden', 'true');
upload_button.append(upload_icon);

buttons_row.append(play, start_time, timeline, end_time, speed, volume_button, volume_container, download_button, upload_button);
pleer.append(track_name, buttons_row);

// time calc func
function timeCalc(time) { 
	time = Math.floor(time);
	let minutes = Math.floor(time / 60);
	let seconds = Math.floor(time - minutes * 60);
	let minutesVal = minutes;
	let secondsVal = seconds;
	if(minutes < 10) {
		minutesVal = '0' + minutes;
	}
	if(seconds < 10) {
		secondsVal = '0' + seconds;
	}
	return minutesVal + ':' + secondsVal;
}

// volume change func
function changeVolume() { 
	let volume = doc.querySelector('.pleer__volume').value / 100;
	track.volume = volume;
}

// speed change func
function changeSpeed() { 
	let speed = doc.querySelector('.pleer__speed').value;
	track.playbackRate = speed;
}

// play/pause func
function play_pause_func() {
	play_pause = !play_pause;
	if (play_pause) {
		doc.querySelector('.pleer__play').innerHTML = '';
		doc.querySelector('.pleer__play').append(pause_icon);
		track.play();
	} else {
		doc.querySelector('.pleer__play').innerHTML = '';
		doc.querySelector('.pleer__play').append(play_icon);
		track.pause();
	}
}

// download func
function download_func() {
	fetch(track.src)
        .then(response => response.blob())
        .then(blob => {
            let url = URL.createObjectURL(blob);
            let a = doc.createElement('a');
            a.href = url;
            a.download = `${doc.querySelector('.pleer__track_name').innerHTML}.mp3`;
            doc.body.appendChild(a);  
            a.click();    
            a.remove();        
        })
        .catch(error => alert(error));
}

// upload func
function upload_func() {
	let formData = new FormData();
	let fileInput = doc.createElement('input');
	fileInput.setAttribute('type', 'file');
	doc.body.appendChild(fileInput);
	fileInput.click();
	formData.append('file', fileInput.files[0]);
	
	/*const options = {
  		method: 'POST',
  		body: formData,
	};

	fetch('upload-url', options)
		.catch(error => alert(error));*/

	fileInput.remove();
}

// add pleer on page
doc.addEventListener('click', (event) => {
	if (event.target.className == 'play_music') {
		track.src = event.target.dataset.href;
		track_name.innerHTML = event.target.dataset.name;
		doc.body.append(pleer);
		

		play_pause = false;
		doc.querySelector('.pleer__play').innerHTML = '';
		doc.querySelector('.pleer__play').append(play_icon);

		// play/pause event
		doc.querySelector('.pleer__play').onclick = play_pause_func;

		// volume event
		doc.querySelector('.pleer__volume_button').onfocus = function() {
			doc.querySelector('.pleer__volume_container').style.display = 'block';
			doc.querySelector('.pleer__volume').focus();
		};

		doc.querySelector('.pleer__volume').onblur = function() {
			doc.querySelector('.pleer__volume_container').style.display = 'none';
		};

		doc.querySelector('.pleer__volume').onchange = function() {
			if (doc.querySelector('.pleer__volume').value < 10) {
				doc.querySelector('.pleer__volume_button').innerHTML = '';
				doc.querySelector('.pleer__volume_button').append(mute_icon);
			} else if ((doc.querySelector('.pleer__volume').value >= 10) && (doc.querySelector('.pleer__volume').value < 60)) {
				doc.querySelector('.pleer__volume_button').innerHTML = '';
				doc.querySelector('.pleer__volume_button').append(middle_volume_icon);
			} else {
				doc.querySelector('.pleer__volume_button').innerHTML = '';
				doc.querySelector('.pleer__volume_button').append(volume_icon);
			}
			changeVolume();
		};

		// timeline event
		doc.querySelector('.pleer__timeline').onchange = function() {
			track.currentTime = this.value;
			doc.querySelector('.pleer__timeline').setAttribute("max", track.duration);
		};

		// timeupdate event
		track.addEventListener('timeupdate', function() {
			let currentTime = parseInt(track.currentTime, 10);
			doc.querySelector('.pleer__timeline').value = currentTime;
			doc.querySelector('.pleer__start_time').value = timeCalc(currentTime);
			doc.querySelector('.pleer__end_time').value = timeCalc(!isNaN(track.duration) ? track.duration - currentTime : 0);
		});

		// speed event
		doc.querySelector('.pleer__speed').onchange = changeSpeed;

		// download event
		doc.querySelector('.pleer__download_button').onclick = download_func;

		// upload event
		doc.querySelector('.pleer__upload_button').onclick = upload_func;
	}  
});
// Designed by:  Mauricio Bucardo
// Original image: https://dribbble.com/shots/6957353-Music-Player-Widget

"use strict";

// add elemnts
const bgBody = ["#e5e7e9", "#ff4545", "#f8ded3", "#ffc382", "#f5eda6", "#ffcbdc", "#dcf3f3"];
const body = document.body;
const player = document.querySelector(".player");
const playerHeader = player.querySelector(".player__header");
const playerControls = player.querySelector(".player__controls");
const playerPlayList = player.querySelectorAll(".player__song");
const playerSongs = player.querySelectorAll(".audio");
const playButton = player.querySelector(".play");
const nextButton = player.querySelector(".next");
const backButton = player.querySelector(".back");
const playlistButton = player.querySelector(".playlist");
const slider = player.querySelector(".slider");
const sliderContext = player.querySelector(".slider__context");
const sliderName = sliderContext.querySelector(".slider__name");
const sliderTitle = sliderContext.querySelector(".slider__title");
const sliderContent = slider.querySelector(".slider__content");
const sliderContentLength = playerPlayList.length - 1;
const sliderWidth = 100;
let left = 0;
let count = 0;
let song = playerSongs[count];
let isPlay = false;
const pauseIcon = playButton.querySelector("img[alt = 'pause-icon']");
const playIcon = playButton.querySelector("img[alt = 'play-icon']");
const progres = player.querySelector(".progres");
const progresFilled = progres.querySelector(".progres__filled");
let isMove = false;

// creat functions
function openPlayer() {

	playerHeader.classList.add("open-header");
	playerControls.classList.add("move");
	slider.classList.add("open-slider");

}

function closePlayer() {

	playerHeader.classList.remove("open-header");
	playerControls.classList.remove("move");
	slider.classList.remove("open-slider");

}

function next(index) {

	count = index || count;

	if (count == sliderContentLength) {
		count = count;
		return;
	}

	left = (count + 1) * sliderWidth;
	left = Math.min(left, (sliderContentLength) * sliderWidth);
	sliderContent.style.transform = `translate3d(-${left}%, 0, 0)`;
	count++;
	run();

}

function back(index) {

	count = index || count;

	if (count == 0) {
		count = count;
		return;
	}

	left = (count - 1) * sliderWidth;
	left = Math.max(0, left);
	sliderContent.style.transform = `translate3d(-${left}%, 0, 0)`;
	count--;
	run();

}

function changeSliderContext() {

	sliderContext.style.animationName = "opacity";

	sliderName.textContent = playerPlayList[count].querySelector(".player__title").textContent;
	sliderTitle.textContent = playerPlayList[count].querySelector(".player__song-name").textContent;

	if (sliderName.textContent.length > 16) {
		const textWrap = document.createElement("span");
		textWrap.className = "text-wrap";
		textWrap.innerHTML = sliderName.textContent + "   " + sliderName.textContent;
		sliderName.innerHTML = "";
		sliderName.append(textWrap);

	}

	if (sliderTitle.textContent.length >= 18) {
		const textWrap = document.createElement("span");
		textWrap.className = "text-wrap";
		textWrap.innerHTML = sliderTitle.textContent + "    " + sliderTitle.textContent;
		sliderTitle.innerHTML = "";
		sliderTitle.append(textWrap);
	}

}

function changeBgBody() {
	body.style.backgroundColor = bgBody[count];
}

function selectSong() {

	song = playerSongs[count];

	for (const item of playerSongs) {

		if (item != song) {
			item.pause();
			item.currentTime = 0;
		}

	}

	if (isPlay) song.play();


}

function run() {

	changeSliderContext();
	changeBgBody();
	selectSong();

}

function playSong() {

	if (song.paused) {
		song.play();
		playIcon.style.display = "none";
		pauseIcon.style.display = "block";

	}else{
		song.pause();
		isPlay = false;
		playIcon.style.display = "";
		pauseIcon.style.display = "";
	}


}

function progresUpdate() {

	const progresFilledWidth = (this.currentTime / this.duration) * 100 + "%";
	progresFilled.style.width = progresFilledWidth;

	if (isPlay && this.duration == this.currentTime) {
		next();
	}
	if (count == sliderContentLength && song.currentTime == song.duration) {
		playIcon.style.display = "block";
		pauseIcon.style.display = "";
		isPlay = false;
	}
}

function scurb(e) {

	// If we use e.offsetX, we have trouble setting the song time, when the mousemove is running
	const currentTime = ( (e.clientX - progres.getBoundingClientRect().left) / progres.offsetWidth ) * song.duration;
	song.currentTime = currentTime;

}

function durationSongs() {
	let min = parseInt(this.duration / 60);
	if (min < 10) min = "0" + min;

	let sec = parseInt(this.duration % 60);
	if (sec < 10) sec = "0" + sec;

	const playerSongTime = `${min}:${sec}`;
	this.closest(".player__song").querySelector(".player__song-time").append(playerSongTime);

}


changeSliderContext();

// add events
sliderContext.addEventListener("click", openPlayer);
sliderContext.addEventListener("animationend", () => sliderContext.style.animationName ='');
playlistButton.addEventListener("click", closePlayer);

nextButton.addEventListener("click", () => {
	next(0)
});

backButton.addEventListener("click", () => {
	back(0)
});

playButton.addEventListener("click", () => {
	isPlay = true;
	playSong();
});

playerSongs.forEach(song => {
	song.addEventListener("loadeddata" , durationSongs);
	song.addEventListener("timeupdate" , progresUpdate);

});

progres.addEventListener("pointerdown", (e) => {
	scurb(e);
	isMove = true;
});

document.addEventListener("pointermove", (e) => {
	if (isMove) {
		scurb(e);
		song.muted = true;
	}
});

document.addEventListener("pointerup", () => {
	isMove = false;
	song.muted = false;
});

playerPlayList.forEach((item, index) => {

	item.addEventListener("click", function() {

		if (index > count) {
			next(index - 1);
			return;
		}

		if (index < count) {
			back(index + 1);
			return;
		}

	});

});
