<section class="content__side">
    <h2 class="content__side-heading">Проекты</h2>

    <nav class="main-navigation">
        <ul class="main-navigation__list">
            <?php foreach ($arCategories as $category) : ?>
                <li class="main-navigation__list-item <?php if (isset($_GET['category']) && $_GET['category'] == $category['id']) echo 'main-navigation__list-item--active'; ?>">
                    <a class="main-navigation__list-item-link" href="/?category=<?= $category['id'] ?>"><?= $category['name']; ?></a>
                    <span class="main-navigation__list-item-count"><?= $category['count_id']; ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <a class="button button--transparent button--plus content__side-button" href="/pages/form-project.php" target="project_add">Добавить проект</a>
</section>

<main class="content__main">
    <h2 class="content__main-heading">Список задач</h2>

    <form class="search-form" action="/index.php" method="get" autocomplete="off">
        <input class="search-form__input" type="text" name="search" value="" placeholder="Поиск по задачам">
        <input class="search-form__submit" type="submit" name="" value="">
    </form>

    <div class="tasks-controls">
        <nav class="tasks-switch">
            <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
            <a href="/?time=today" class="tasks-switch__item">Повестка дня</a>
            <a href="/?time=tomorrow" class="tasks-switch__item">Завтра</a>
            <a href="/?time=late" class="tasks-switch__item">Просроченные</a>
        </nav>

        <label class="checkbox">
            <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
            <input class="checkbox__input visually-hidden show_completed" type="checkbox" <?php if ($show_complete_tasks == 1)  echo 'checked'; ?>>
            <span class="checkbox__text">Показывать выполненные</span>
        </label>
    </div>
    <?php if (isset($arTask['no_task'])) : ?>
        <p class="noTask"><?= $arTask['no_task']; ?></p>
    <?php else : ?>
        <form method="POST" id="change-status-task">
            <table class="tasks">
                <?php foreach ($arTask as $task) : ?>
                    <?php if ($show_complete_tasks == 0 && $task["status"] !== false) {
                        continue;
                    } ?>
                    <tr class="tasks__item task<?php if ($task["status"] !== false) echo " task--completed"; ?><?php if (diffTime($task['date']) == false) echo " task--important"; ?>">
                        <td class="task__select">
                            <label class="checkbox task__checkbox">
                                <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" name="task_<?=$task["id"]?>" value="<?=$task["id"]?>">
                                <span class="checkbox__text"><?= $task['name']; ?></span>
                            </label>
                        </td>

                        <td class="task__file">
                            <a class="download-link" href="<?= $task['filePath'] ?>"><?= $task['fileName'] ?></a>
                        </td>

                        <td class="task__date"><?= $task['date']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>                
            <button class="button button--transparent hidden" type="submit">Сохранить</button>
        </form>
    <?php endif; ?>
</main>