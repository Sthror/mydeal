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

    <a class="button button--transparent button--plus content__side-button" href="form-project.php">Добавить проект</a>
</section>

<main class="content__main">
    <h2 class="content__main-heading">Добавление проекта</h2>

    <form class="form" method="post" autocomplete="off">
        <div class="form__row">
            <label class="form__label" for="project_name">Название <sup>*</sup></label>

            <input class="form__input<?if (isset($errors['name'])) echo ' form__input--error';?>" type="text" name="name" id="project_name" value="" placeholder="Введите название проекта">
        </div>

        <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
            <?php if (isset($errors['name'])) : ?>
                <p class="form_message"><?= $errors['name']; ?></p>
            <?php endif; ?>
        </div>
    </form>
</main>