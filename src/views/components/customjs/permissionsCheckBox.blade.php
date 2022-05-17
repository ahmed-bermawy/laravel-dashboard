{{--check the parent of  permissions checkbox when his childrens is checked --}}
<script>
    function groupCheck(parentId) {
    var parent = document.getElementById(parentId);
    var allChecked = document.getElementsByName('permissions[]');
    for (var i = 0; i < allChecked.length; i++) {
    if (allChecked[i].id.split('-')[0] === parent.name)
    allChecked[i].checked = parent.checked;
}
}
    {{-- toggle collapse permissions checkbox --}}
    function collapseCard(className) {
    var cards = document.getElementsByClassName(className);
    for (var i = 0; i < cards.length; i++) {
    cards[i].classList.toggle("d-none");
}
}
</script>
