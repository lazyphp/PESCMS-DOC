
    <script src="<?= DOCUMENT_ROOT ?>/Theme/assets/js/diff.js"></script>
    <div class="am-cf am-padding-top am-padding-bottom">
        <div class="tm-content am-margin">
            <article class="am-article tm-article">

                <div class="am-article-bd">
                    <div id="settings" class="am-padding-left">

                        <div class="am-form-group">
                            <label class="am-radio-inline am-padding-0">
                                <b>对比方式</b>:
                            </label>
                            <label class="am-radio-inline">
                                <input type="radio" value="diffChars" name="diff_type" checked> 仅显示差异
                            </label>
                            <label class="am-radio-inline">
                                <input type="radio" value="diffWords" name="diff_type"> 整合对比
                            </label>
                            <label class="am-radio-inline">
                                <input type="radio" value="diffLines" name="diff_type"> 文本行对比
                            </label>
                        </div>
                    </div>
                    <div class="am-g am-form">
                        <div class="am-u-sm-6 tm-border-right compare-now ">
                            <p class="am-article-lead">目前版本</p>
                            <div id="current-version">
                                <?= htmlspecialchars_decode($now); ?>
                            </div>
                        </div>
                        <div class="am-u-sm-6 compare-history">
                            <p class="am-article-lead">历史版本</p>
                            <div id="history-version">
                                <?= htmlspecialchars_decode($history); ?>
                            </div>
                        </div>
                    </div>
                    <div id="diffent-result" class="am-padding">

                    </div>
                </div>
            </article>
        </div>
    </div>

    <script>
        var a = document.getElementById('current-version');
        var b = document.getElementById('history-version');
        var result = document.getElementById('diffent-result');

        function changed() {
            var diff = JsDiff[window.diffType](a.textContent, b.textContent);
            var fragment = document.createDocumentFragment();
            for (var i=0; i < diff.length; i++) {

                if (diff[i].added && diff[i + 1] && diff[i + 1].removed) {
                    var swap = diff[i];
                    diff[i] = diff[i + 1];
                    diff[i + 1] = swap;
                }

                var node;
                if (diff[i].removed) {
                    node = document.createElement('del');
                    node.appendChild(document.createTextNode(diff[i].value));
                } else if (diff[i].added) {
                    node = document.createElement('ins');
                    node.appendChild(document.createTextNode(diff[i].value));
                } else {
                    node = document.createTextNode(diff[i].value);
                }
                fragment.appendChild(node);
            }

            result.textContent = '';
            result.appendChild(fragment);
        }

        window.onload = function() {
            onDiffTypeChange(document.querySelector('#settings [name="diff_type"]:checked'));
            changed();
        };

        a.onpaste = a.onchange =
            b.onpaste = b.onchange = changed;

        if ('oninput' in a) {
            a.oninput = b.oninput = changed;
        } else {
            a.onkeyup = b.onkeyup = changed;
        }

        function onDiffTypeChange(radio) {
            window.diffType = radio.value;
            document.title = "Diff " + radio.value.slice(4);
        }

        var radio = document.getElementsByName('diff_type');
        for (var i = 0; i < radio.length; i++) {
            radio[i].onchange = function(e) {
                onDiffTypeChange(e.target);
                changed();
            }
        }
    </script>
