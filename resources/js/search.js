import { liteClient as algoliasearch } from 'algoliasearch/lite'
import instantsearch from 'instantsearch.js'
import { configure, hits, searchBox } from 'instantsearch.js/es/widgets'

const searchClient = algoliasearch('U3YBE7MWDD', 'f1a2f54730610b8c4b54bc7f65b481aa')

const search = instantsearch({
	indexName: 'products',
	searchClient,
	future: {
		preserveSharedStateOnUnmount: true
	},
})

search.addWidgets([
	searchBox({
		container: "#searchbox",
		placeholder: 'Tìm kiếm sản phẩm',
		cssClasses: {
			input: 'input mb-4',
			submit: 'hidden',
			reset: 'hidden',
		},
	}),
	configure({
		hitsPerPage: 4,
	}),
	hits({
		container: "#hits",
		templates: {
			item: (hit, { html, components }) => html
				`<div class="product-card hover:text-red-600 hover:cursor-pointer mb-4 overflow-hidden">
					<a href="product/${hit.slug}" class="flex items-center text-sm">
						<div class="hit-image flex-shrink-0">
							<img src="${hit.image ? '/storage/uploads/products/' + hit.image : '/storage/uploads/products/product-placehoder.jpg'}" alt="${hit.name}" class="img-md object-cover" />
						</div>
						<div class="p-4">
							<div class="hit-name font-medium text-base">${components.Highlight({ hit, attribute: "name" })}</div>
							<div class="hit-description line-clamp-1">${components.Highlight({ hit, attribute: "description" })}</div>
						</div>
						<div class="hit-price text-right ms-auto p-4">
							<p class="line-through">
								${hit.discount_price ? new Intl.NumberFormat('vi-VI', { style: 'currency', currency: 'VND' }).format(hit.discount_price) : ''}
							</p>
							<p class="font-medium">${new Intl.NumberFormat('vi-VI', { style: 'currency', currency: 'VND' }).format(hit.price)}</p>
						</div>
					</a>
				</div>
			`,
		},
		cssClasses: {
			root: 'grid gap-4 grid-cols-1',
		},
	}),
])

export default search
