document.addEventListener('DOMContentLoaded', () => {
    async function initWsgMap({ mapId, points, center, zoom }) {
        const { Map } = await google.maps.importLibrary('maps');
        await google.maps.importLibrary('marker');

        const map = new Map(document.getElementById(mapId), {
            center: {
                lat: parseFloat(center.lat),
                lng: parseFloat(center.lng),
            },
            zoom: parseFloat(zoom),
            mapId,
        });

        points.forEach((el) => {
            const marker = new google.maps.marker.AdvancedMarkerElement({
                map,
                position: {
                    lat: parseFloat(el.lat),
                    lng: parseFloat(el.lng),
                },
            });

            if (el.desc) {
                const infowindow = new google.maps.InfoWindow({
                    content: el.desc,
                });

                marker.addListener('click', () => {
                    infowindow.open({
                        anchor: marker,
                        map,
                    });
                });
            }
        });
    }

    const wsmData = document.getElementsByClassName('wsm-data');

    Array.from(wsmData).forEach((el) => {
        const data = JSON.parse(el.innerText);

        initWsgMap(data);
    });
});