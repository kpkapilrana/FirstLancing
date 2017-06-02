#include <stdio.h>
#define M 1000000007
long A[1000],N;
int main()
{
    long i=0,prod=1;
    scanf("%d",&N);
    
    while(i<N)
    {
        scanf("%d",&A[i]);
        i++;
    }
    i=0;
    while(i<N){
        prod=(prod*A[i])%M;
        i++;
    }
    printf("%d",prod);
    return 0;
}
