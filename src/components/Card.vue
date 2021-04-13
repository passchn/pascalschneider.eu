<template>
    <div class="cardenv">
    <b-card no-body class="overflow-hidden" style="max-width: 750px;">
        <b-row no-gutters>
        <b-col md="4" v-if="img">
            <b-card-img-lazy :src="'/img/cards/'+img" :alt="title" style="max-width:250px;" class="rounded-0"></b-card-img-lazy>
        </b-col>
        <b-col :md="mdText">
            <b-card-body>
                <h3>{{ title }}</h3>
            <b-card-text class="content">
                {{ content }}
                <div class="buttonsMargin" v-if="hasButtons"></div>
            </b-card-text>
            <div class="buttons" v-if="hasButtons">
                <b-button v-if="more" :to="more" variant="primary">Info</b-button>
                <b-button v-if="github" :href="github" target="_blank" variant="dark">Github</b-button>
                <b-button v-if="website" :href="website" target="_blank" variant="dark">Website</b-button>
            </div>
            </b-card-body>
        </b-col>
        </b-row>
    </b-card>
    </div>
</template>

<style scoped>
.buttons .btn {
    margin: 2px; 
}
.buttons {
    position: absolute; bottom: 15px; 
}
.buttonsMargin {
    margin-bottom: 55px; 
}
.cardenv {
    margin-top: 12px;
}
</style>

<script>
export default {
    name: 'Card',
    props: [
        'title',
        'content',
        'img',
        'github',
        'website',
        'more'
    ],
    created() {
        this.mdText = 8
        if (!this.img) {
            this.mdText = 12
        }
        this.hasButtons = false
        if (this.github || this.website || this.more) {
            this.hasButtons = true
        }
    }
}
</script>
