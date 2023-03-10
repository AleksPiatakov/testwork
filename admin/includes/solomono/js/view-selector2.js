! function(e) {
    function t(r) {
        if (i[r]) return i[r].exports;
        var o = i[r] = {
            exports: {},
            id: r,
            loaded: !1
        };
        return e[r].call(o.exports, o, o.exports, t), o.loaded = !0, o.exports
    }
    var i = {};
    return t.m = e, t.c = i, t.p = "", t(0)
}([function(e, t, i) {
    "use strict";

    function r(e) {
        return e && e.__esModule ? e : {
            "default": e
        }
    }
    var o = i(1),
        s = r(o);
    gapi.analytics.ready(function() {
        function e(e, t, i) {
            e.innerHTML = t.map(function(e) {
                var t = e.id == i ? "selected " : " ";
                return "<option " + t + 'value="' + e.id + '">' + e.name + "</option>"
            }).join("")
        }

        function t(e) {
            return e.ids || e.viewId ? {
                prop: "viewId",
                value: e.viewId || e.ids && e.ids.replace(/^ga:/, "")
            } : e.propertyId ? {
                prop: "propertyId",
                value: e.propertyId
            } : e.accountId ? {
                prop: "accountId",
                value: e.accountId
            } : void 0
        }
        gapi.analytics.createComponent("ViewSelector2", {
            execute: function() {
                return this.setup_(function() {
                    this.updateAccounts_(), this.changed_ && (this.render_(), this.onChange_())
                }.bind(this)), this
            },
            set: function(e) {
                if (!!e.ids + !!e.viewId + !!e.propertyId + !!e.accountId > 1) throw new Error('You cannot specify more than one of the following options: "ids", "viewId", "accountId", "propertyId"');
                if (e.container && this.container) throw new Error("You cannot change containers once a view selector has been rendered on the page.");
                var t = this.get();
                return t.ids == e.ids && t.viewId == e.viewId && t.propertyId == e.propertyId && t.accountId == e.accountId || (t.ids = null, t.viewId = null, t.propertyId = null, t.accountId = null), gapi.analytics.Component.prototype.set.call(this, e)
            },
            setup_: function(e) {
                var t = this,
                    i = function() {
                        s["default"].get().then(function(i) {
                            t.summaries = i, t.accounts = t.summaries.all(), e()
                        }, function(e) {
                            t.emit("error", e)
                        })
                    };
                gapi.analytics.auth.isAuthorized() ? i() : gapi.analytics.auth.on("signIn", i)
            },
            updateAccounts_: function() {
                var e = this.get(),
                    i = t(e),
                    r = void 0,
                    o = void 0,
                    s = void 0;
                if (!this.summaries.all().length) return void this.emit("error", new Error('This user does not have any Google Analytics accounts. You can sign up at "www.google.com/analytics".'));
                if (i) switch (i.prop) {
                    case "viewId":
                        r = this.summaries.getProfile(i.value), o = this.summaries.getAccountByProfileId(i.value), s = this.summaries.getWebPropertyByProfileId(i.value);
                        break;
                    case "propertyId":
                        s = this.summaries.getWebProperty(i.value), o = this.summaries.getAccountByWebPropertyId(i.value), r = s && s.views && s.views[0];
                        break;
                    case "accountId":
                        o = this.summaries.getAccount(i.value), s = o && o.properties && o.properties[0], r = s && s.views && s.views[0]
                } else o = this.accounts[0], s = o && o.properties && o.properties[0], r = s && s.views && s.views[0];
                o || s || r ? o == this.account && s == this.property && r == this.view || (this.changed_ = {
                    account: o && o != this.account,
                    property: s && s != this.property,
                    view: r && r != this.view
                }, this.account = o, this.properties = o.properties, this.property = s, this.views = s && s.views, this.view = r, this.ids = r && "ga:" + r.id) : this.emit("error", new Error("This user does not have access to " + i.prop.slice(0, -2) + " : " + i.value))
            },
            render_: function() {
                var t = this.get();
                this.container = "string" == typeof t.container ? document.getElementById(t.container) : t.container, this.container.innerHTML = t.template || this.template;
                var i = this.container.querySelectorAll("select"),
                    r = this.accounts,
                    o = this.properties || [{
                        name: "(Empty)",
                        id: ""
                    }],
                    s = this.views || [{
                        name: "(Empty)",
                        id: ""
                    }];
                e(i[0], r, this.account.id), e(i[1], o, this.property && this.property.id), e(i[2], s, this.view && this.view.id), i[0].onchange = this.onUserSelect_.bind(this, i[0], "accountId"), i[1].onchange = this.onUserSelect_.bind(this, i[1], "propertyId"), i[2].onchange = this.onUserSelect_.bind(this, i[2], "viewId")
            },
            onChange_: function() {
                var e = {
                    account: this.account,
                    property: this.property,
                    view: this.view,
                    ids: this.view && "ga:" + this.view.id
                };
                this.changed_ && (this.changed_.account && this.emit("accountChange", e), this.changed_.property && this.emit("propertyChange", e), this.changed_.view && (this.emit("viewChange", e), this.emit("idsChange", e), this.emit("change", e.ids))), this.changed_ = null
            },
            onUserSelect_: function(e, t) {
                var i = {};
                i[t] = e.value, this.set(i), this.execute()
            },
            template: '<div class="ViewSelector2">  <div class="ViewSelector2-item">    <label class="label bg-primary text-white m-r-10">Account</label>    <select class="FormField"></select>  </div>  <div class="ViewSelector2-item">    <label class="label bg-success text-white m-r-10">Property</label>    <select class="FormField"></select>  </div>  <div class="ViewSelector2-item">    <label class="label bg-info text-white m-r-10">View</label>    <select class="FormField"></select>  </div></div>'
        })
    })
}, function(e, t, i) {
    function r() {
        var e = gapi.client.request({
            path: n
        }).then(function(e) {
            return e
        });
        return new e.constructor(function(t, i) {
            var r = [];
            e.then(function o(e) {
                var c = e.result;
                c.items ? r = r.concat(c.items) : i(new Error("You do not have any Google Analytics accounts. Go to http://google.com/analytics to sign up.")), c.startIndex + c.itemsPerPage <= c.totalResults ? gapi.client.request({
                    path: n,
                    params: {
                        "start-index": c.startIndex + c.itemsPerPage
                    }
                }).then(o) : t(new s(r))
            }).then(null, i)
        })
    }
    var o, s = i(2),
        n = "/analytics/v3/management/accountSummaries";
    e.exports = {
        get: function(e) {
            return e && (o = null), o || (o = r())
        }
    }
}, function(e, t) {
    function i(e) {
        this.accounts_ = e, this.webProperties_ = [], this.profiles_ = [], this.accountsById_ = {}, this.webPropertiesById_ = this.propertiesById_ = {}, this.profilesById_ = this.viewsById_ = {};
        for (var t, i = 0; t = this.accounts_[i]; i++)
            if (this.accountsById_[t.id] = {
                    self: t
                }, t.webProperties) {
                r(t, "webProperties", "properties");
                for (var o, s = 0; o = t.webProperties[s]; s++)
                    if (this.webProperties_.push(o), this.webPropertiesById_[o.id] = {
                            self: o,
                            parent: t
                        }, o.profiles) {
                        r(o, "profiles", "views");
                        for (var n, c = 0; n = o.profiles[c]; c++) this.profiles_.push(n), this.profilesById_[n.id] = {
                            self: n,
                            parent: o,
                            grandParent: t
                        }
                    }
            }
    }

    function r(e, t, i) {
        Object.defineProperty ? Object.defineProperty(e, i, {
            get: function() {
                return e[t]
            }
        }) : e[i] = e[t]
    }
    i.prototype.all = function() {
        return this.accounts_
    }, r(i.prototype, "all", "allAccounts"), i.prototype.allWebProperties = function() {
        return this.webProperties_
    }, r(i.prototype, "allWebProperties", "allProperties"), i.prototype.allProfiles = function() {
        return this.profiles_
    }, r(i.prototype, "allProfiles", "allViews"), i.prototype.get = function(e) {
        if (!!e.accountId + !!e.webPropertyId + !!e.propertyId + !!e.profileId + !!e.viewId > 1) throw new Error('get() only accepts an object with a single property: either "accountId", "webPropertyId", "propertyId", "profileId" or "viewId"');
        return this.getProfile(e.profileId || e.viewId) || this.getWebProperty(e.webPropertyId || e.propertyId) || this.getAccount(e.accountId)
    }, i.prototype.getAccount = function(e) {
        return this.accountsById_[e] && this.accountsById_[e].self
    }, i.prototype.getWebProperty = function(e) {
        return this.webPropertiesById_[e] && this.webPropertiesById_[e].self
    }, r(i.prototype, "getWebProperty", "getProperty"), i.prototype.getProfile = function(e) {
        return this.profilesById_[e] && this.profilesById_[e].self
    }, r(i.prototype, "getProfile", "getView"), i.prototype.getAccountByProfileId = function(e) {
        return this.profilesById_[e] && this.profilesById_[e].grandParent
    }, r(i.prototype, "getAccountByProfileId", "getAccountByViewId"), i.prototype.getWebPropertyByProfileId = function(e) {
        return this.profilesById_[e] && this.profilesById_[e].parent
    }, r(i.prototype, "getWebPropertyByProfileId", "getPropertyByViewId"), i.prototype.getAccountByWebPropertyId = function(e) {
        return this.webPropertiesById_[e] && this.webPropertiesById_[e].parent
    }, r(i.prototype, "getAccountByWebPropertyId", "getAccountByPropertyId"), e.exports = i
}]);
//# sourceMappingURL=view-selector2.js.map
