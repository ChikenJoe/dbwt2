<script>
export default {
    props: ['items']
}
</script>

<template>
    <!-- Block: menu -->
    <nav class="menu">
        <!-- Element: list -->
        <ul class="menu__list">
            <li
                v-for="item in items"
                :key="item.text"
                class="menu__item"
                :class="{ 'menu__item--has-children': item.children }"
            >
                <!-- Element: link -->
                <a
                    :href="item.url"
                    class="menu__link"
                    :class="{ 'menu__link--active': item.active }"
                >
                    {{ item.text }}
                </a>

                <!-- Element: sublist -->
                <ul v-if="item.children" class="menu__sublist">
                    <li
                        v-for="child in item.children"
                        :key="child.text"
                        class="menu__subitem"
                    >
                        <!-- Element: sublink -->
                        <a :href="child.url" class="menu__sublink">
                            {{ child.text }}
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</template>


<!--<style scoped lang="scss">-->
<!--/* Block */-->
<!--.menu {-->
<!--    font-family: Amiri;-->

<!--    /* Element */-->
<!--    &__list {-->
<!--        list-style: none;-->
<!--        display: flex;-->
<!--        margin: 0;-->
<!--        padding: 0;-->
<!--    }-->

<!--    &__item {-->
<!--        position: relative;-->
<!--        margin-right: 20px;-->

<!--        /* Modifier für Items mit Untermenü */-->
<!--        &&#45;&#45;has-children {-->
<!--            cursor: pointer;-->

<!--            /* Element sublist wird bei Hover sichtbar */-->
<!--            &:hover .menu__sublist {-->
<!--                display: block;-->
<!--            }-->
<!--        }-->
<!--    }-->

<!--    &__link {-->
<!--        text-decoration: none;-->
<!--        color: #333;-->

<!--        /* Modifier für aktiven Link */-->
<!--        &&#45;&#45;active {-->
<!--            font-weight: bold;-->
<!--            color: #2a9d8f;-->
<!--        }-->
<!--    }-->

<!--    /* Element: sublist (Dropdown) */-->
<!--    &__sublist {-->
<!--        display: none;-->
<!--        position: absolute;-->
<!--        top: 100%;-->
<!--        left: 0;-->
<!--        background-color: #a1a09a;-->
<!--        list-style: none;-->
<!--        padding: 0.5rem 0;-->
<!--        margin: 0;-->
<!--    }-->

<!--    &__subitem {-->
<!--        padding: 0.5rem 1rem;-->
<!--    }-->

<!--    &__sublink {-->
<!--        color: #fff;-->
<!--        text-decoration: none;-->
<!--        display: block;-->
<!--    }-->
<!--}-->
<!--</style>-->

<style scoped lang="scss">

$menu-bg: #ffffff;
$menu-text: #000000;
$menu-hover-bg: #c1c1c1;
$menu-active-color: #0a5a93;
$dropdown-bg: #a1a09a;
$dropdown-item-hover: darken($dropdown-bg, 10%);
$font-base: 'Amiri', serif;
$transition-time: 0.3s;


@mixin transition($props...) {
    transition: $props $transition-time ease-in-out;
}

.menu {
    font-family: $font-base;
    background: $menu-bg;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 0.5rem 1rem;
    display: flex;
    justify-content: center;

    &__list {
        display: flex;
        gap: 1.5rem;      // flex gap statt margin-right
        margin: 0;
        padding: 0;
    }

    &__item {
        position: relative;

        &--has-children {
            &:hover {
                cursor: pointer;
                > .menu__link {
                    color: $menu-active-color;
                }
            }

            &:hover .menu__sublist {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
        }
    }

    &__link {
        display: inline-block;
        padding: 0.5rem 0.75rem;
        color: $menu-text;
        text-decoration: none;
        @include transition(color, background);

        &:hover {
            color: $menu-active-color;
            background: $menu-hover-bg;
            border-radius: 4px;
        }

        &--active {
            color: $menu-active-color;
            font-weight: bold;
        }
    }

    &__sublist {
        position: absolute;
        top: 100%;
        left: 0;
        background: $dropdown-bg;
        list-style: none;
        margin: 0;
        padding: 0.5rem 0;
        border-radius: 4px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        opacity: 0;
        visibility: hidden;
        transform: translateX(+10px);
        @include transition(opacity, visibility, transform);
        z-index: 10;
    }

    &__subitem {
        .menu__sublink {
            display: block;
            padding: 0.5rem 1rem;
            color: #fff;
            text-decoration: none;
            @include transition(background);

            &:hover {
                background: $dropdown-item-hover;
            }
        }
    }
}
</style>
