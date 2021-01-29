<body>
	<div class="container">
		<form class="adder" name="form" action="" method="post">
			<input type="text" name="taskItem">
			<button name="addTask">Добавить задачу</button>
			<button name="deleteAll">Удалить все</button>
			<button name="doneAll">Выполнить все</button>
		</form>	
		<h1 class="listHead">Список дел</h1>

		<form class='list' action='' method='post'>
			<?php foreach($showIndex as $row) :?>
				<?php 
				if ($row->status!=0) {
					$task_status = "done";
				} else {
					$task_status = "notDone";
				}
				?>
				<div class='<?php echo $task_status?>'><p class='task'>
					<?php echo $row->description; ?></p><br>
					<div class='buttons'><button name=delete value='<?php echo $row->id ?>'>Удалить</button>
						<button name=done value='<?php echo $row->id ?>'>Выполнено/Не выполнено</button></div>
					</div>
				<?php endforeach;?> 
				<form>
					<a href="http://controller">На страницу авторизации</a>