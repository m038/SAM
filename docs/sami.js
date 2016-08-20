
(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href=".html">intrawarez</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:intrawarez_slim3annotations" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="intrawarez/slim3annotations.html">slim3annotations</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:intrawarez_slim3annotations_annotations" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="intrawarez/slim3annotations/annotations.html">annotations</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:intrawarez_slim3annotations_annotations_ANY" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="intrawarez/slim3annotations/annotations/ANY.html">ANY</a>                    </div>                </li>                            <li data-name="class:intrawarez_slim3annotations_annotations_Annotation" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="intrawarez/slim3annotations/annotations/Annotation.html">Annotation</a>                    </div>                </li>                            <li data-name="class:intrawarez_slim3annotations_annotations_Annotations" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="intrawarez/slim3annotations/annotations/Annotations.html">Annotations</a>                    </div>                </li>                            <li data-name="class:intrawarez_slim3annotations_annotations_DELETE" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="intrawarez/slim3annotations/annotations/DELETE.html">DELETE</a>                    </div>                </li>                            <li data-name="class:intrawarez_slim3annotations_annotations_Dependency" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="intrawarez/slim3annotations/annotations/Dependency.html">Dependency</a>                    </div>                </li>                            <li data-name="class:intrawarez_slim3annotations_annotations_GET" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="intrawarez/slim3annotations/annotations/GET.html">GET</a>                    </div>                </li>                            <li data-name="class:intrawarez_slim3annotations_annotations_Group" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="intrawarez/slim3annotations/annotations/Group.html">Group</a>                    </div>                </li>                            <li data-name="class:intrawarez_slim3annotations_annotations_Method" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="intrawarez/slim3annotations/annotations/Method.html">Method</a>                    </div>                </li>                            <li data-name="class:intrawarez_slim3annotations_annotations_Middleware" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="intrawarez/slim3annotations/annotations/Middleware.html">Middleware</a>                    </div>                </li>                            <li data-name="class:intrawarez_slim3annotations_annotations_OPTIONS" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="intrawarez/slim3annotations/annotations/OPTIONS.html">OPTIONS</a>                    </div>                </li>                            <li data-name="class:intrawarez_slim3annotations_annotations_POST" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="intrawarez/slim3annotations/annotations/POST.html">POST</a>                    </div>                </li>                            <li data-name="class:intrawarez_slim3annotations_annotations_PUT" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="intrawarez/slim3annotations/annotations/PUT.html">PUT</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:intrawarez_slim3annotations_App" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="intrawarez/slim3annotations/App.html">App</a>                    </div>                </li>                            <li data-name="class:intrawarez_slim3annotations_CallableResolver" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="intrawarez/slim3annotations/CallableResolver.html">CallableResolver</a>                    </div>                </li>                            <li data-name="class:intrawarez_slim3annotations_DelegateInterface" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="intrawarez/slim3annotations/DelegateInterface.html">DelegateInterface</a>                    </div>                </li>                            <li data-name="class:intrawarez_slim3annotations_DependencyInjector" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="intrawarez/slim3annotations/DependencyInjector.html">DependencyInjector</a>                    </div>                </li>                            <li data-name="class:intrawarez_slim3annotations_GroupDelegate" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="intrawarez/slim3annotations/GroupDelegate.html">GroupDelegate</a>                    </div>                </li>                            <li data-name="class:intrawarez_slim3annotations_GroupMethodDelegate" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="intrawarez/slim3annotations/GroupMethodDelegate.html">GroupMethodDelegate</a>                    </div>                </li>                </ul></div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "intrawarez.html", "name": "intrawarez", "doc": "Namespace intrawarez"},{"type": "Namespace", "link": "intrawarez/slim3annotations.html", "name": "intrawarez\\slim3annotations", "doc": "Namespace intrawarez\\slim3annotations"},{"type": "Namespace", "link": "intrawarez/slim3annotations/annotations.html", "name": "intrawarez\\slim3annotations\\annotations", "doc": "Namespace intrawarez\\slim3annotations\\annotations"},
            {"type": "Interface", "fromName": "intrawarez\\slim3annotations", "fromLink": "intrawarez/slim3annotations.html", "link": "intrawarez/slim3annotations/DelegateInterface.html", "name": "intrawarez\\slim3annotations\\DelegateInterface", "doc": "&quot;Interface for delegates.&quot;"},
                                                        {"type": "Method", "fromName": "intrawarez\\slim3annotations\\DelegateInterface", "fromLink": "intrawarez/slim3annotations/DelegateInterface.html", "link": "intrawarez/slim3annotations/DelegateInterface.html#method_getCallable", "name": "intrawarez\\slim3annotations\\DelegateInterface::getCallable", "doc": "&quot;&quot;"},
            
            {"type": "Interface", "fromName": "intrawarez\\slim3annotations\\annotations", "fromLink": "intrawarez/slim3annotations/annotations.html", "link": "intrawarez/slim3annotations/annotations/Annotation.html", "name": "intrawarez\\slim3annotations\\annotations\\Annotation", "doc": "&quot;Interface for slim annotations.&quot;"},
                    
            
            {"type": "Class", "fromName": "intrawarez\\slim3annotations", "fromLink": "intrawarez/slim3annotations.html", "link": "intrawarez/slim3annotations/App.html", "name": "intrawarez\\slim3annotations\\App", "doc": "&quot;An extension of \\Slim\\App which loads its handlers automatically,\ndepending on annotation markup.&quot;"},
                                                        {"type": "Method", "fromName": "intrawarez\\slim3annotations\\App", "fromLink": "intrawarez/slim3annotations/App.html", "link": "intrawarez/slim3annotations/App.html#method_create", "name": "intrawarez\\slim3annotations\\App::create", "doc": "&quot;Creates a new App instances.&quot;"},
                    {"type": "Method", "fromName": "intrawarez\\slim3annotations\\App", "fromLink": "intrawarez/slim3annotations/App.html", "link": "intrawarez/slim3annotations/App.html#method___construct", "name": "intrawarez\\slim3annotations\\App::__construct", "doc": "&quot;Constructs a new App instance from a given container.&quot;"},
                    {"type": "Method", "fromName": "intrawarez\\slim3annotations\\App", "fromLink": "intrawarez/slim3annotations/App.html", "link": "intrawarez/slim3annotations/App.html#method_getNamespaces", "name": "intrawarez\\slim3annotations\\App::getNamespaces", "doc": "&quot;Gets the array behind the container&#039;s &lt;b&gt;&amp;#64;namespaces&lt;\/b&gt; id.&quot;"},
                    {"type": "Method", "fromName": "intrawarez\\slim3annotations\\App", "fromLink": "intrawarez/slim3annotations/App.html", "link": "intrawarez/slim3annotations/App.html#method_load", "name": "intrawarez\\slim3annotations\\App::load", "doc": "&quot;Loads a given class.&quot;"},
                    {"type": "Method", "fromName": "intrawarez\\slim3annotations\\App", "fromLink": "intrawarez/slim3annotations/App.html", "link": "intrawarez/slim3annotations/App.html#method_loadAll", "name": "intrawarez\\slim3annotations\\App::loadAll", "doc": "&quot;Loads all given classes.&quot;"},
                    {"type": "Method", "fromName": "intrawarez\\slim3annotations\\App", "fromLink": "intrawarez/slim3annotations/App.html", "link": "intrawarez/slim3annotations/App.html#method_loadNamespace", "name": "intrawarez\\slim3annotations\\App::loadNamespace", "doc": "&quot;Loads all given namespaces.&quot;"},
                    {"type": "Method", "fromName": "intrawarez\\slim3annotations\\App", "fromLink": "intrawarez/slim3annotations/App.html", "link": "intrawarez/slim3annotations/App.html#method_loadAllNamespaces", "name": "intrawarez\\slim3annotations\\App::loadAllNamespaces", "doc": "&quot;Loads all given namespaces.&quot;"},
            
            {"type": "Class", "fromName": "intrawarez\\slim3annotations", "fromLink": "intrawarez/slim3annotations.html", "link": "intrawarez/slim3annotations/CallableResolver.html", "name": "intrawarez\\slim3annotations\\CallableResolver", "doc": "&quot;Implementation of CallableResolverInterface for delegates.&quot;"},
                                                        {"type": "Method", "fromName": "intrawarez\\slim3annotations\\CallableResolver", "fromLink": "intrawarez/slim3annotations/CallableResolver.html", "link": "intrawarez/slim3annotations/CallableResolver.html#method___construct", "name": "intrawarez\\slim3annotations\\CallableResolver::__construct", "doc": "&quot;Constructs a new callable resolver with a given container.&quot;"},
                    {"type": "Method", "fromName": "intrawarez\\slim3annotations\\CallableResolver", "fromLink": "intrawarez/slim3annotations/CallableResolver.html", "link": "intrawarez/slim3annotations/CallableResolver.html#method_resolve", "name": "intrawarez\\slim3annotations\\CallableResolver::resolve", "doc": "&quot;Resolves a given value to a callable.&quot;"},
            
            {"type": "Class", "fromName": "intrawarez\\slim3annotations", "fromLink": "intrawarez/slim3annotations.html", "link": "intrawarez/slim3annotations/DelegateInterface.html", "name": "intrawarez\\slim3annotations\\DelegateInterface", "doc": "&quot;Interface for delegates.&quot;"},
                                                        {"type": "Method", "fromName": "intrawarez\\slim3annotations\\DelegateInterface", "fromLink": "intrawarez/slim3annotations/DelegateInterface.html", "link": "intrawarez/slim3annotations/DelegateInterface.html#method_getCallable", "name": "intrawarez\\slim3annotations\\DelegateInterface::getCallable", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "intrawarez\\slim3annotations", "fromLink": "intrawarez/slim3annotations.html", "link": "intrawarez/slim3annotations/DependencyInjector.html", "name": "intrawarez\\slim3annotations\\DependencyInjector", "doc": "&quot;Abstract implementation of delgates.&quot;"},
                                                        {"type": "Method", "fromName": "intrawarez\\slim3annotations\\DependencyInjector", "fromLink": "intrawarez/slim3annotations/DependencyInjector.html", "link": "intrawarez/slim3annotations/DependencyInjector.html#method_newInstance", "name": "intrawarez\\slim3annotations\\DependencyInjector::newInstance", "doc": "&quot;Creates a new instance of a given reflection class with injected dependencies from a given container.&quot;"},
            
            {"type": "Class", "fromName": "intrawarez\\slim3annotations", "fromLink": "intrawarez/slim3annotations.html", "link": "intrawarez/slim3annotations/GroupDelegate.html", "name": "intrawarez\\slim3annotations\\GroupDelegate", "doc": "&quot;Delegate implementation for Slim groups.&quot;"},
                                                        {"type": "Method", "fromName": "intrawarez\\slim3annotations\\GroupDelegate", "fromLink": "intrawarez/slim3annotations/GroupDelegate.html", "link": "intrawarez/slim3annotations/GroupDelegate.html#method___construct", "name": "intrawarez\\slim3annotations\\GroupDelegate::__construct", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "intrawarez\\slim3annotations\\GroupDelegate", "fromLink": "intrawarez/slim3annotations/GroupDelegate.html", "link": "intrawarez/slim3annotations/GroupDelegate.html#method_getCallable", "name": "intrawarez\\slim3annotations\\GroupDelegate::getCallable", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "intrawarez\\slim3annotations", "fromLink": "intrawarez/slim3annotations.html", "link": "intrawarez/slim3annotations/GroupMethodDelegate.html", "name": "intrawarez\\slim3annotations\\GroupMethodDelegate", "doc": "&quot;Delegate implementation for group methods.&quot;"},
                                                        {"type": "Method", "fromName": "intrawarez\\slim3annotations\\GroupMethodDelegate", "fromLink": "intrawarez/slim3annotations/GroupMethodDelegate.html", "link": "intrawarez/slim3annotations/GroupMethodDelegate.html#method___construct", "name": "intrawarez\\slim3annotations\\GroupMethodDelegate::__construct", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "intrawarez\\slim3annotations\\GroupMethodDelegate", "fromLink": "intrawarez/slim3annotations/GroupMethodDelegate.html", "link": "intrawarez/slim3annotations/GroupMethodDelegate.html#method_getCallable", "name": "intrawarez\\slim3annotations\\GroupMethodDelegate::getCallable", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "intrawarez\\slim3annotations\\annotations", "fromLink": "intrawarez/slim3annotations/annotations.html", "link": "intrawarez/slim3annotations/annotations/ANY.html", "name": "intrawarez\\slim3annotations\\annotations\\ANY", "doc": "&quot;The annotation for ANY handlers.&quot;"},
                    
            {"type": "Class", "fromName": "intrawarez\\slim3annotations\\annotations", "fromLink": "intrawarez/slim3annotations/annotations.html", "link": "intrawarez/slim3annotations/annotations/Annotation.html", "name": "intrawarez\\slim3annotations\\annotations\\Annotation", "doc": "&quot;Interface for slim annotations.&quot;"},
                    
            {"type": "Class", "fromName": "intrawarez\\slim3annotations\\annotations", "fromLink": "intrawarez/slim3annotations/annotations.html", "link": "intrawarez/slim3annotations/annotations/Annotations.html", "name": "intrawarez\\slim3annotations\\annotations\\Annotations", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "intrawarez\\slim3annotations\\annotations\\Annotations", "fromLink": "intrawarez/slim3annotations/annotations/Annotations.html", "link": "intrawarez/slim3annotations/annotations/Annotations.html#method_Group", "name": "intrawarez\\slim3annotations\\annotations\\Annotations::Group", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "intrawarez\\slim3annotations\\annotations\\Annotations", "fromLink": "intrawarez/slim3annotations/annotations/Annotations.html", "link": "intrawarez/slim3annotations/annotations/Annotations.html#method_GroupMiddlewares", "name": "intrawarez\\slim3annotations\\annotations\\Annotations::GroupMiddlewares", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "intrawarez\\slim3annotations\\annotations\\Annotations", "fromLink": "intrawarez/slim3annotations/annotations/Annotations.html", "link": "intrawarez/slim3annotations/annotations/Annotations.html#method_Dependency", "name": "intrawarez\\slim3annotations\\annotations\\Annotations::Dependency", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "intrawarez\\slim3annotations\\annotations\\Annotations", "fromLink": "intrawarez/slim3annotations/annotations/Annotations.html", "link": "intrawarez/slim3annotations/annotations/Annotations.html#method_Method", "name": "intrawarez\\slim3annotations\\annotations\\Annotations::Method", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "intrawarez\\slim3annotations\\annotations\\Annotations", "fromLink": "intrawarez/slim3annotations/annotations/Annotations.html", "link": "intrawarez/slim3annotations/annotations/Annotations.html#method_MethodMiddlewares", "name": "intrawarez\\slim3annotations\\annotations\\Annotations::MethodMiddlewares", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "intrawarez\\slim3annotations\\annotations", "fromLink": "intrawarez/slim3annotations/annotations.html", "link": "intrawarez/slim3annotations/annotations/DELETE.html", "name": "intrawarez\\slim3annotations\\annotations\\DELETE", "doc": "&quot;The annotation for DELETE handlers.&quot;"},
                    
            {"type": "Class", "fromName": "intrawarez\\slim3annotations\\annotations", "fromLink": "intrawarez/slim3annotations/annotations.html", "link": "intrawarez/slim3annotations/annotations/Dependency.html", "name": "intrawarez\\slim3annotations\\annotations\\Dependency", "doc": "&quot;The annotation for route patterns.&quot;"},
                    
            {"type": "Class", "fromName": "intrawarez\\slim3annotations\\annotations", "fromLink": "intrawarez/slim3annotations/annotations.html", "link": "intrawarez/slim3annotations/annotations/GET.html", "name": "intrawarez\\slim3annotations\\annotations\\GET", "doc": "&quot;The annotation for GET handlers.&quot;"},
                    
            {"type": "Class", "fromName": "intrawarez\\slim3annotations\\annotations", "fromLink": "intrawarez/slim3annotations/annotations.html", "link": "intrawarez/slim3annotations/annotations/Group.html", "name": "intrawarez\\slim3annotations\\annotations\\Group", "doc": "&quot;The annotation for slim groups&quot;"},
                    
            {"type": "Class", "fromName": "intrawarez\\slim3annotations\\annotations", "fromLink": "intrawarez/slim3annotations/annotations.html", "link": "intrawarez/slim3annotations/annotations/Method.html", "name": "intrawarez\\slim3annotations\\annotations\\Method", "doc": "&quot;The base class for HTTP method annotation handlers.&quot;"},
                    
            {"type": "Class", "fromName": "intrawarez\\slim3annotations\\annotations", "fromLink": "intrawarez/slim3annotations/annotations.html", "link": "intrawarez/slim3annotations/annotations/Middleware.html", "name": "intrawarez\\slim3annotations\\annotations\\Middleware", "doc": "&quot;The annotation for middlewares.&quot;"},
                    
            {"type": "Class", "fromName": "intrawarez\\slim3annotations\\annotations", "fromLink": "intrawarez/slim3annotations/annotations.html", "link": "intrawarez/slim3annotations/annotations/OPTIONS.html", "name": "intrawarez\\slim3annotations\\annotations\\OPTIONS", "doc": "&quot;The annotation for OPTIONS handlers.&quot;"},
                    
            {"type": "Class", "fromName": "intrawarez\\slim3annotations\\annotations", "fromLink": "intrawarez/slim3annotations/annotations.html", "link": "intrawarez/slim3annotations/annotations/POST.html", "name": "intrawarez\\slim3annotations\\annotations\\POST", "doc": "&quot;The annotation for POST handlers.&quot;"},
                    
            {"type": "Class", "fromName": "intrawarez\\slim3annotations\\annotations", "fromLink": "intrawarez/slim3annotations/annotations.html", "link": "intrawarez/slim3annotations/annotations/PUT.html", "name": "intrawarez\\slim3annotations\\annotations\\PUT", "doc": "&quot;The annotation for PUT handlers.&quot;"},
                    
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


