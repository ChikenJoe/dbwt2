<template>
    <div class="article-form">
        <form class="article-form__form" @submit.prevent="submitArticle">
            <fieldset class="article-form__fieldset">
                <legend class="article-form__legend">Neuen Artikel anlegen</legend>

                <div class="article-form__field article-form__field--required">
                    <label class="article-form__label" for="name">Artikelname:</label>
                    <input
                        class="article-form__input"
                        type="text"
                        id="name"
                        v-model="name"
                        placeholder="Artikelname"
                    />
                </div>

                <div class="article-form__field">
                    <label class="article-form__label" for="price">Preis:</label>
                    <input
                        class="article-form__input"
                        type="number"
                        id="price"
                        v-model.number="price"
                        placeholder="Preis"
                    />
                </div>

                <div class="article-form__field">
                    <label class="article-form__label" for="description">Beschreibung:</label>
                    <textarea
                        class="article-form__textarea"
                        id="description"
                        v-model="description"
                        placeholder="Beschreibung"
                    ></textarea>
                </div>

                <div class="article-form__field">
                    <button
                        class="article-form__button"
                        type="submit"
                        :disabled="!formValid"
                        :class="{ 'article-form__button--disabled': !formValid }"
                    >
                        Speichern
                    </button>
                </div>
            </fieldset>
        </form>

        <div
            v-if="feedback"
            class="article-form__feedback"
            :class="{ 'article-form__feedback--error': feedbackError }"
        >
            {{ feedback }}
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: "",
            price: null,
            description: "",
            feedback: "",
            feedbackError: false,
        };
    },
    computed: {
        formValid() {
            return this.name.trim() !== "" && this.price > 0;
        },
    },
    methods: {
        submitArticle() {
            this.feedback = "";
            this.feedbackError = false;

            if (!this.formValid) {
                this.feedback = "Bitte füllen Sie alle Felder korrekt aus.";
                this.feedbackError = true;
                return;
            }

            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content');

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "/api/articles");
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.setRequestHeader("Accept", "application/json");
            xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);

            xhr.onload = () => {
                if (xhr.status >= 200 && xhr.status < 300) {
                    let responseData = {};
                    try {
                        responseData = JSON.parse(xhr.responseText);
                    } catch (e) {}
                    this.feedback = responseData.message || "Artikel erfolgreich angelegt!";
                    this.name = "";
                    this.price = null;
                    this.description = "";
                } else {
                    this.feedback = "Fehler beim Absenden: " + xhr.statusText;
                    this.feedbackError = true;
                }
            };
            xhr.onerror = () => {
                this.feedback = "Netzwerkfehler";
                this.feedbackError = true;
            };

            xhr.send(
                JSON.stringify({ name: this.name, price: this.price, description: this.description })
            );
        },
    },
};
</script>

<style lang="scss" scoped>


$main-color: #3498db;
$error-color: #e74c3c;
$spacing: 0.5rem;
$error-color: #e74c3c;
$spacing: 0.5rem;

@mixin flex-center {
    display: flex;
    justify-content: center;
    align-items: center;
}



%centered {
    @include flex-center;
}

.article-form {
    @extend %centered;
    flex-direction: column;
    padding: $spacing * 2;

    &__form {
        width: 100%;
        max-width: 400px;
    }

    &__fieldset {
        border: 1px solid $main-color;
        padding: $spacing;
    }

    &__legend {
        margin-bottom: $spacing;
        font-weight: bold;
    }

    &__field {
        margin-bottom: $spacing;
        &--required {
            label::after {
                content: '*';
                color: $error-color;
                margin-left: 0.25rem;
            }
        }
    }

    &__label {
        display: block;
        margin-bottom: 0.25rem;
    }

    &__input,
    &__textarea {
        width: 100%;
        padding: $spacing;
        border: 1px solid $main-color;

        &:focus {
            border-color: darken($main-color, 10%);
        }

        &--error {
            border-color: $error-color;
        }
    }

    &__button {
        @include flex-center;
        padding: $spacing $spacing * 2;
        background: $main-color;
        color: #fff;
        border: none;

        &:disabled {
            cursor: not-allowed;
        }

        &--disabled {
            background: darken($main-color, 20%);
        }
    }

    &__feedback {
        margin-top: $spacing;


        &--error {
            color: $error-color;
        }
    }
}
</style>
