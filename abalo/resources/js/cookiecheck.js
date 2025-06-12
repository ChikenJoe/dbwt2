export function cookieCheck(){

        const cookieName = "cookieConsent";
        const cookieValue = getCookie(cookieName);

        if (!cookieValue) {
            showCookieBanner();
        }

        function showCookieBanner() {
            const banner = document.createElement("div");
            banner.innerHTML = `
                <div id="cookie-banner" style="
                    display: flex;
                    position: fixed;
                    bottom: 0;
                    width: 100%;
                    background: #222;
                    color: white;
                    padding: 1rem;
                    align-items: center;
                    z-index: 1000;
                ">
                    <span>Diese Website verwendet optionale Cookies. Sind Sie damit einverstanden?</span>

                        <button id="acceptCookies" style="margin: 10px;">Akzeptieren</button>
                        <button id="declineCookies">Ablehnen</button>

                </div>
            `;
            banner.id = "cookie-modal"
            document.body.appendChild(banner);

            document.getElementById("acceptCookies").addEventListener("click", function () {
                setCookie(cookieName, "accepted", 365);
                removeBanner();
            });

            document.getElementById("declineCookies").addEventListener("click", function () {
                removeBanner();
            });
        }

        function setCookie(name, value, days) {
            const expires = new Date();
            expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/`;
        }

        function getCookie(name) {
            const match = document.cookie.match(new RegExp("(^| )" + name + "=([^;]+)"));
            return match ? match[2] : null;
        }

        function removeBanner() {
            const banner = document.getElementById("cookie-banner");
            if (banner) {
                banner.remove();
            }
        }
}
