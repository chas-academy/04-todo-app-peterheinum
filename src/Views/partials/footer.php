<footer class="footer" >
    <span class="todo-count"><?= count(array_filter($todos, function($todo) { return $todo['completed'] === "false"; })) ?> item<?= "".count($todos) !== 1 ? "s" : "" ?> left</span>
    <form method="POST" action="/todos/clearCompleted">
    <button class="clear-completed" type="submit">Clear completed</button>
    </form>    
    <a class="clear-completed" href="/todos/filterCompleted" style="margin-right:8px;">Filter completed</a> 
    <a class="clear-completed" href="/todos/filterUnCompleted" style="margin-right:8px;">Filter uncompleted</a>    
</footer>


</main>

<footer class="site-footer">
    <div class="small-container">
        <p class="text-center">Made by <a href="https://github.com/peterheinum/">Peter</a></p>
    </div>
</footer>
<form method="post" action="/todos/search" style="border:solid 1px lightgray;padding:5px;border-radius:5px;">
    <input type="text"  placeholder="filter todos with text" name="searchtext">
    <button class="clear-completed" type="submit">Search</button>
    </form>

<script type="module" src="<?= $this->getScript('scripts'); ?>"></script>

</body>

</html>