/*!
 * Listener auf links, damit in iOS WebApp diese nicht in Safari geöffnet werden
 * @author Nico Florin
 */
$(document).on(
        "click",
        "a",
        function (event) {

            // Standard verhindern (Link in Safari öffnen)
            event.preventDefault();

            // location von Pfad wechseln
            location.href = $(event.target).attr("href");

        }
);