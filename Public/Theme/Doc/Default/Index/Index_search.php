<form data-am-validator>
    <input type="hidden" name="g" value="Doc">
    <input type="hidden" name="m" value="<?= MODULE ?>">
    <input type="hidden" name="a" value="search">
    <input type="text" name="keyword" placeholder="<?= $indexSetting['search_placeholder'] ?? '' ?>" required>
    <button type="submit" class="am-btn am-btn-default"><i class="am-icon-search"></i> 搜索</button>
</form>