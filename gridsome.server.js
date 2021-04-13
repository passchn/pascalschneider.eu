// Server API makes it possible to hook into various parts of Gridsome
// on server-side and add custom data to the GraphQL data layer.
// Learn more: https://gridsome.org/docs/server-api/

// Changes here require a server restart.
// To restart press CTRL + C in terminal and run `gridsome develop`

module.exports = function (api) {

  const lang = 'en'

  // Index Page 
  api.loadSource(async actions => {
    const data = require(`./src/data/${lang}/index.json`);
    const collection = actions.addCollection({
      typeName: 'indexPage'
    })
    collection.addNode(data)
  })

  // CV data
  api.loadSource(async actions => {
    const CVdata = require(`./src/data/${lang}/cv-data.json`);
    //const CVdata = JSON.parse(CV.cv)
    const collection = actions.addCollection({
      typeName: 'CV'
    })
    for (const entry of CVdata) {
      collection.addNode(entry)
    }
  })

  // CV Page 
  api.loadSource(async actions => {
    const data = require(`./src/data/${lang}/cv.json`);
    const collection = actions.addCollection({
      typeName: 'cvPage'
    })
    collection.addNode(data)
  })

  // Contact Page 
  api.loadSource(async actions => {
    const data = require(`./src/data/${lang}/contact.json`);
    const collection = actions.addCollection({
      typeName: 'contactPage'
    })
    collection.addNode(data)
  })

  // Etc.  
  api.loadSource(async actions => {
    const data = require(`./src/data/${lang}/etc.json`);
    const collection = actions.addCollection({
      typeName: 'etcData'
    })
    collection.addNode(data)
  })


  api.createPages(({ createPage }) => {
    // Use the Pages API here: https://gridsome.org/docs/pages-api/
  })
}
