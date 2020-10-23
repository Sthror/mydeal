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

    <a class="button button--transparent button--plus content__side-button" href="form-project.html">Добавить проект</a>
</section>

<main class="content__main">
    <h2 class="content__main-heading"><?= $title ?></h2>

    <form class="form" method="post" autocomplete="off" enctype="multipart/form-data">
        <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>
            <input class="form__input<?if (isset($errors['name'])) echo ' form__input--error';?>" type="text" name="name" id="name" value="<?= getPostVal('name'); ?>" placeholder="Введите название">
            <?php if (isset($errors['name'])) : ?>
                <p class="form_message"><?= $errors['name']; ?></p>
            <?php endif; ?>
        </div>

        <div class="form__row">
            <label class="form__label" for="project">Проект <sup>*</sup></label>

            <select class="form__input form__input--select<?if (isset($errors['project'])) echo ' form__input--error';?>" name="project" id="project">
                <option value="">Выберете проект:</option>
                <?php foreach ($arCategories as $category) : ?>
                    <option value="<?= $category['id']; ?>" <?if($category['id']==getPostVal('project'))echo ' selected' ;?>><?= $category['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['project'])) : ?>
                <p class="form_message"><?= $errors['project']; ?></p>
            <?php endif; ?>
        </div>

        <div class="form__row">
            <label class="form__label" for="date">Дата выполнения</label>

            <input class="form__input form__input--date<?if (isset($errors['date'])) echo ' form__input--error';?>" type="text" name="date" id="date" value="<?= getPostVal('date'); ?>" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
            <?php if (isset($errors['date'])) : ?>
                <p class="form_message"><?= $errors['date']; ?></p>
            <?php endif; ?>
        </div>
        <?php
        if (isset($fileURL)) {
            echo "<a href='$fileURL'>$fileName</a>";
        }
        ?>
        <div class="form__row">
            <label class="form__label" for="file">Файл</label>

            <div class="form__input-file">
                <input class="visually-hidden" type="file" name="file" id="file" value="">

                <label class="button button--transparent" for="file">
                    <span>Выберите файл</span>
                </label>
            </div>
        </div>

        <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
        </div>
    </form>
</main>