<template>
    <div id="cv" class="mb-3">
        <p
        v-for="entry in $static.cv.edges"
        :key="entry.node.id"
        :class="'cv-entry '+entry.node.cat+' '+isHighlighted(focus, entry.node.cat)"
        @click="highlight(entry.node.cat)"
        >
            <small class="year">{{ entry.node.y }}</small><br />
            <strong class="txt">
              <span class="icon">
                <fa :icon="getIcon(entry.node.cat)" />
              </span>
              {{ entry.node.txt }}
            </strong><br />
            <span class="info">{{ entry.node.info }}</span>
        </p>
    </div> 
</template>

<static-query>
query {
  cv: allCv (order: ASC) {
    edges {
      node {
        id
        y
        cat
        txt
        info
      }
    }
  }
}
</static-query>

<style scoped>
.cv-entry.highlight {
  color: var(--one); 
  transition: color 0.2s;
}
.cv-entry {
  cursor: pointer; 
}
</style>

<script>
export default {
    name: 'CV',
    data() {
      return {
        highlighted: false
      }
    },
    props: [
        'focus'
    ],
    methods: {
      getIcon(cat) {
        const icons = {
          edu: 'user-graduate',
          tech: 'code',
          journalism: 'photo-video'
        }
        if (undefined !== icons[cat]) {
          return icons[cat]
        }
        return null
      },
      highlight(cat, emit) {
        if (emit !== false) {
          this.$emit('highlightCV', cat)
        }
        Array.from(document.getElementsByClassName('cv-entry')).forEach(e => {
          e.classList.remove('highlight')
          if (e.classList.contains(cat)) {
            e.classList.add('highlight')
          }
        })
      },
      isHighlighted(focus, cat) {
        if (focus === cat) {
          return 'highlight'
        }
        return ''
      }
    }
}
</script>