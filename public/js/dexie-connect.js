let db = new Dexie('basket_database');
db.version(1).stores({
	basketItems: 'id, amount, totalAmount, name, img, price'
});