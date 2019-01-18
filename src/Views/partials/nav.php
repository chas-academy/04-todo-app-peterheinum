<header class="header">
    <h1>todos</h1>
    <form id="create-todo" method="post" action="/todos">
      <input name="title" class="new-todo" placeholder="What needs to be done?" autofocus>
    </form>
</header>

<section class="main">
<form action="todos/toggle-all" method="POST">
    <input id="toggle-all" class="toggle-all" type="checkbox" onclick="submit()">
    <label for="toggle-all">Mark all as complete</label>
    </form>
</section>