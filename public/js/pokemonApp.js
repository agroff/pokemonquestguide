var PQG = {

    /**
     * contains all local storage data for the site
     */
    db: {},

    loadDbData: function () {
        var data = localStorage.getItem("pqg-data"),
            requiredKeys = [
                'hideables'
            ],
            requiredArrays = [
                'recipes'
            ];


        if (!data) {
            data = {};
        }
        else {
            data = JSON.parse(data);
        }

        for (var i = 0; i < requiredKeys.length; i++) {
            var key = requiredKeys[i];

            if (!data[key]) {
                data[key] = {};
            }
        }

        for (var i = 0; i < requiredArrays.length; i++) {
            var key = requiredArrays[i];

            if (!data[key]) {
                data[key] = [];
            }
        }

        this.db = data;
    },

    saveDb: function () {
        var data = JSON.stringify(this.db);
        localStorage.setItem("pqg-data", data);
        console.log(data);
    },

    expandRecipes: function () {
        $("body").on("click", ".attract-header", function () {
            var $button = $(".expand-button", $(this)),
                $parent = $button.closest(".recipe-container");

            if ($parent.hasClass("expanded")) {
                $parent.removeClass("expanded");
                $button.html("+");
            }
            else {
                $parent.addClass("expanded");
                $button.html("-");
            }
        });
    },

    hideableContent: function () {

        var that = this,
            hideables = this.db.hideables,
            uri = location.pathname.substr(1),
            autoHide = false;

        if(hideables.hasOwnProperty(uri) && hideables[uri] === true){
            autoHide = true;
        }

        $(".hideable-content").each(function () {
            var $container = $(this);
            var $link = $("<a class='hide-link' href='#'>Hide Text</a>");
            var $link2 = $("<a class='show-link' href='#'>Show Text</a>");

            $link2.hide();
            $container.prepend($link);
            $container.before($link2);

            $link.click(function () {
                $container.hide();
                $link2.show();
                that.db.hideables[uri] = true;
                that.saveDb();
            });

            $link2.click(function () {
                $container.show();
                $link2.hide();
                that.db.hideables[uri] = false;
                that.saveDb();
            });

            if(autoHide){
                $link.click();
            }
        });
    }
};

$(function () {
    PQG.loadDbData();
    PQG.expandRecipes();
    PQG.hideableContent();
});