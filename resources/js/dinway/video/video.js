document.addEventListener('DOMContentLoaded', function() {
    const findVideos = () => {
        let videos = document.querySelectorAll('.video');
        
        for (let i = 0; i < videos.length; i++) {
            setupVideo(videos[i]);
        }
    }

    const setupVideo = video => {
        const link = video.querySelector('.video__link');
        const media = video.querySelector('.video__media');
        const button = video.querySelector('.video__button');
        const id = parseMediaURL(media);

        video.addEventListener('click', () => {
            const iframe = createIframe(id);

            link.remove();
            button.remove();
            video.appendChild(iframe);
        });

        const span = document.createElement('span');
        span.className = link.className;
        span.innerHTML = link.innerHTML;
        link.replaceWith(span);
        link.remove();

        video.classList.add('video--enabled');
    }

    const parseMediaURL = media => {
        const regexp = /https:\/\/i\.ytimg\.com\/vi\/([a-zA-Z0-9_-]+)\/maxresdefault\.jpg/i;
        const url = media.src;
        const match = url.match(regexp);

        return match[1];
    }

    const createIframe = id => {
        const iframe = document.createElement('iframe');

        iframe.setAttribute('allowfullscreen', '');
        iframe.setAttribute('allow', 'autoplay');
        iframe.setAttribute('src', generateURL(id));
        iframe.classList.add('video__media');

        return iframe;
    }

    const generateURL = id => {
        let query = '?rel=0&showinfo=0&autoplay=1';

        return 'https://www.youtube.com/embed/' + id + query;
    }

    findVideos();
});

    
