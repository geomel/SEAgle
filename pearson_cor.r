arr1 <- lapply(strsplit(x, ','), as.numeric)[[1]]
arr2 <- lapply(strsplit(y, ','), as.numeric)[[1]]


pearson <- cor.test(arr1,arr2,method="pearson",exact=F)
ttest <- t.test(arr1,arr2)

print(pearson$p.value)
