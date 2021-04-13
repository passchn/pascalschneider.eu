<template>
    <Layout>
        <div>
            <b-tabs 
                id="cv-tabs" 
                content-class="mt-3"
                v-model="activeTab"    
            >
                <b-tab 
                    title-link-class="text-dark"
                    @click="highlight('tech')"
                    id="tech"
                >
                    <template #title>
                        <fa icon="code"/> {{ data.tech.title }}
                    </template>
                    <h2>{{ data.tech.title_long }}</h2>
                    <p class="block">{{ data.tech.content }}</p>
                    <div
                        v-if="data.tech.show_cards"
                        class="mt-5"
                    >
                        <div
                            v-for="card in data.tech.cards"
                            :key="card.title"
                        >
                            <Card 
                                :title="card.title"
                                :img="card.image"
                                :content="card.content"
                                :more="card.more"
                                :github="card.github"
                                :website="card.website"
                            />
                        </div>
                    </div>
                </b-tab>
                <b-tab
                    title-link-class="text-dark"
                    @click="highlight('journalism')"
                    id="journalism"
                >
                    <template #title>
                        <fa icon="photo-video"/> {{ data.journalism.title }}
                    </template>
                    <h2>{{ data.journalism.title_long }}</h2>
                    <p class="block">{{ data.journalism.content }}</p>
                    <div
                        v-if="data.journalism.show_cards"
                    >
                        <div
                            v-for="card in data.journalism.cards"
                            :key="card.title"
                        >
                            <Card 
                                :title="card.title"
                                :img="card.image"
                                :content="card.content"
                                :more="card.more"
                                :github="card.github"
                                :website="card.website"
                            />
                        </div>
                    </div>
                </b-tab>
                <b-tab
                    title-link-class="text-dark"
                    @click="highlight('edu')"
                    id="edu"
                >
                    <template #title>
                        <fa icon="user-graduate"/> {{ data.edu.title }}
                    </template>
                    <h2>{{ data.edu.title_long }}</h2>
                    <p class="block">{{ data.edu.content }}</p>
                    <div
                        v-if="data.edu.show_cards"
                    >
                        <div
                            v-for="card in data.edu.cards"
                            :key="card.title"
                        >
                            <Card 
                                :title="card.title"
                                :img="card.image"
                                :content="card.content"
                                :more="card.more"
                                :github="card.github"
                                :website="card.website"
                            />
                        </div>
                    </div>
                </b-tab>
            </b-tabs>
        </div>
        <template slot="sidebar">
            <h2> {{ data.etc.sidebar_title }} </h2>
            <CV 
                :focus="focus"
                v-on:highlightCV="changeTab($event)"
            />
        </template>
    </Layout>
</template>

<page-query>
query MyQuery {
  allCvPage {
    edges {
      node {
        edu {
          content
          title
          title_long
          show_cards
          cards {
            title
            content
            image
            more
            github
            website
          }
        }
        journalism {
          content
          title
          title_long
          show_cards
          cards {
            title
            content
            image
            more
            github
            website
          }
        }
        tech {
          content
          title
          title_long
          show_cards
          cards {
            title
            content
            image
            more
            github
            website
          }
        }
        etc {
            sidebar_title
        }
      }
    }
  }
}
</page-query>

<style scoped>
.activelink {
    display: none; 
    /* color: var(--one) !important; */
}
</style>

<script>

import CV from '~/components/CV.vue'
import Card from '~/components/Card.vue'

export default {
    metaInfo: {
        title: 'CV'
    },
    components: {
      CV,
      Card
    },
    created() {
        this.data = this.$page.allCvPage.edges[0].node
    },
    data() {
        return {
            focus: 'tech',
            activeTab: 0,
        }
    },
    methods: {
        highlight(x) {
            this.focus = x
        },
        changeTab(e) {
            this.focus = e
            switch (e) {
                case 'edu': 
                    this.activeTab = 2
                    break;
                case 'journalism':
                    this.activeTab = 1
                    break;
                case 'tech':
                    this.activeTab = 0
                    break;
                default: 
                this.activeTab = 0;
                break;
            }
        },
        loggo(d) {
            console.log(d)
        }
    }
}
</script>
